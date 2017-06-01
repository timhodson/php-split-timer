<?php

namespace SplitTimer;

class TimerTest extends \PHPUnit_Framework_TestCase
{
    public function testStartStopTimer()
    {
        $timer = new Timer();
        $timer->start();
        sleep(1);
        $timer->stop();

        $this->assertNotEmpty($timer->elapsed(), 'Should not be empty');
        $this->assertInternalType('float', $timer->elapsed(), 'Should be a float');
    }

    public function testStartTimerAndStopWithElapsed()
    {
        $timer = new Timer();
        $timer->start();

        $elapsed = $timer->elapsed();
        $this->assertEquals($elapsed, $timer->elapsed(),
            'Elapsed should always be the same because the timer should have stopped');
    }

    public function testSplits()
    {
        $timer = new Timer();
        $timer->start();
        sleep(1);
        $timer->split();
        $timer->start();
        sleep(1);
        $timer->split();

        $this->assertNotEmpty($timer->meanSplit());
        $this->assertCount(2, $timer->getSplits(), 'Should be two splits');
    }

    public function testTimerNotStarted()
    {
        $this->setExpectedException('\Exception', 'Timer was never started');
        $timer = new Timer();
        $timer->stop();
    }
}
