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
        $request->shouldReceive('user')->andReturn((object)[ 'activity' => serialize([ 'register' ]) ]);

        $this->progress = new \App\Services\FaizProgress($request, new \App\Services\OptimusHashID);
    }

    protected function _after()
    {
        m::close();
    }

    // tests
    public function test_initial_progress()
    {
        $this->assertEquals($this->progress->getProgress(), $this->progress->distribution('register'));
    }

}