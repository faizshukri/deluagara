<?php

use \Mockery as m;

class FaizProgressTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public $progress;

    protected function _before()
    {
        $user = m::mock('StdClass');
        $user->id = 1;
        $user->activity = serialize([ 'register' ]);

        $user->shouldReceive('save')->andReturn(true);

        $request = m::mock('\Illuminate\Http\Request');
        $request->shouldReceive('user')->andReturn($user);

        $hashid = m::mock('App\Services\OptimusHashID');
        $hashid->shouldReceive('encode')->with(m::any())->andReturn(278840911);

        $this->progress = new \App\Services\FaizProgress($request, $hashid);

        $this->progress->distribution = [
            'register' => [
                'point' => 20,
                'condition' => function() {
                    return false;
                }
            ],
            'about_us' => [
                'point' => 30,
                'condition' => function() {
                    return false;
                }
            ],
            'profile_image' => [
                'point' => 50,
                'condition' => function() {
                    return true;
                }
            ]
        ];
    }

    protected function _after()
    {
        m::close();
    }

    public function test_initial_progress()
    {
        $this->assertEquals(20, $this->progress->getProgress());
        $this->assertEquals(0, $this->progress->getPoint('notexist'));
    }

    public function test_more_initial_progress()
    {
        $this->progress->activity = ['register', 'profile_image', 'address', 'about_me' ];

        $point = 0;
        foreach($this->progress->activity as $activity){
            $point += $this->progress->getPoint($activity);
        }

        $this->assertEquals($point, $this->progress->getProgress());
    }

    public function test_if_activity_point_exceed_100()
    {
        $this->progress->distribution = [
            'activity2' => ['point'=>80, 'condition'=> function(){ return false; }],
            'activity3' => ['point'=>50, 'condition'=> function(){ return false; }],
            'activity4' => ['point'=>70, 'condition'=> function(){ return false; }]
        ];

        $this->progress->activity = ['activity2', 'activity3'];

        $total = 0;
        foreach($this->progress->distribution as $distribution){
            $total += $distribution['point'];
        }

        $this->assertLessThanOrEqual(100, $this->progress->getProgress());
        $this->assertEquals(65, $this->progress->getProgress());
    }

    public function test_add_activity()
    {
        $this->progress->distribution = [
            'activity2' => ['point'=>80, 'condition'=> function(){ return false; }],
            'activity3' => ['point'=>70, 'condition'=> function(){ return true; }],
        ];

        $this->progress->addActivity('activity2');
        $this->progress->addActivity('activity3');
        $this->assertNotContains('activity2', $this->progress->activity);
        $this->assertContains('activity3', $this->progress->activity);
    }

    public function test_percentage_is_rounded_value()
    {
        $this->progress->distribution = [
            'activity2' => ['point'=>70, 'condition'=> function(){ return false; }],
            'activity3' => ['point'=>60, 'condition'=> function(){ return false; }],
        ];

        $this->progress->activity = ['activity2'];

        $this->assertEquals(54, $this->progress->getProgress());
    }

    public function test_if_user_unset_data()
    {
        $this->assertEquals(20, $this->progress->getProgress());

        $this->progress->updateProgress();
        $this->assertEquals(70, $this->progress->getProgress());

        $this->progress->distribution['profile_image']['condition'] = function(){ return false; };
        $this->progress->updateProgress();
        $this->assertEquals(20, $this->progress->getProgress());

        $this->progress->distribution['profile_image']['condition'] = function(){ return true; };
        $this->progress->updateProgress();
        $this->assertEquals(70, $this->progress->getProgress());
    }
}