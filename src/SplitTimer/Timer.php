<?php

namespace SplitTimer;

/**
 * A simple timer
 * Class Timer
 */
class Timer
{
    private $startTime = null;
    private $endTime = null;
    /**
     * The calculated elapsed time
     * @var float
     */
    private $elapsed;

    /**
     * Always use floats from microtime for our calculations.
     * @var bool
     */
    private $asFloat = true;

    /**
     * Number of digits precision to use in rounding
     * @var int
     */
    private $precision;

    /**
     * An array to hold lap times
     * @var array
     */
    private $splits = array();

    /**
     * Timer constructor.
     * If you set $asFloat to false, you will get the result in microseconds
     *
     * @param int $precision round values to this precision
     */
    public function __construct($precision = 3)
    {
        $this->precision = $precision;
    }

    /**
     * Start the timer
     */
    public function start()
    {
        $this->endTime   = null;
        $this->startTime = microtime($this->asFloat);
    }

    /**
     * Stop the timer
     */
    public function stop()
    {
        if ($this->startTime === null) {
            throw new \Exception("Timer was never started");
        }
        $this->endTime = microtime($this->asFloat);
    }

    /**
     * Return the elapsed time.
     *
     * @return float
     * @throws \Exception
     */
    public function elapsed()
    {
        $this->calculateElapsed();

        return round($this->elapsed, $this->precision);
    }

    /**
     * Calculate the elapsed time
     * Stops the timer if it has not already been stopped.
     * Throws an exception if the timer was never started.
     *
     * @return float
     * @throws \Exception
     */
    private function calculateElapsed()
    {
        if ($this->startTime === null) {
            throw new \Exception("Timer was never started");
        }

        if ($this->endTime === null) {
            $this->stop();
        }

        return $this->elapsed = $this->endTime - $this->startTime;
    }

    /**
     * stop the timer and capture the elapsed time.
     */
    public function split()
    {
        array_push($this->splits, $this->calculateElapsed());
    }

    /**
     * Calculte the mean average time spent on each lap.
     * @return float
     */
    public function meanSplit()
    {
        return round(array_sum($this->splits) / count($this->splits), $this->precision);
    }

    /**
     * Calulate the mode average time spent on each lap.
     * @return mixed
     */
    public function modeSplit()
    {
        $mapped = array_map(function ($n) {
            return (string)round($n, $this->precision);
        }, $this->splits);
        $values = array_count_values($mapped);

        return array_search(max($values), $values);
    }

    /**
     * Get the fastest time
     * @return float
     */
    public function fastest()
    {
        return round(min($this->splits), $this->precision);
    }

    /**
     * get the slowest time
     * @return float
     */
    public function slowest()
    {
        return round(max($this->splits), $this->precision);
    }

    /**
     * Get the splits
     * @return array
     */
    public function getSplits()
    {
        return $this->splits;
    }
}
