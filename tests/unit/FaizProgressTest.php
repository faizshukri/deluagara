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
        $request = m::mock('\Illuminate\Http\Request');
        $request->shouldReceive('user')->andReturn((object)[ 'id' => '1', 'activity' => serialize([ 'register' ]) ]);

        $hashid = m::mock('App\Services\OptimusHashID');
        $hashid->shouldReceive('encode')->with(m::any())->andReturn(278840911);

        $this->progress = new \App\Services\FaizProgress($request, $hashid);
    }

    protected function _after()
    {
        m::close();
    }

    // tests
    public function test_initial_progress()
    {
        $this->assertEquals($this->progress->getProgress(), $this->progress->distribution('register'));
        $this->assertEquals($this->progress->distribution('notexist'), 0);
    }

}