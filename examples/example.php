<?php
$appRoot = dirname(__FILE__);
include($appRoot . '/../vendor/autoload.php');

use SplitTimer\Timer;

$timer = new Timer();

for ($i=1; $i <= 10; $i++) {
    $timer->start(); // start the timer

    // do something wildly interesting...
    echo "loop $i\n";
    sleep(rand(1, 5));

    $timer->split(); // stop the timer and record a split
}

echo "Mode: " . $timer->modeSplit() . " seconds\n";
echo "Mean: " . $timer->meanSplit() . " seconds\n";
echo "Fastest: " .$timer->fastest() . " seconds\n";
echo "Slowest: " . $timer->slowest() . " seconds\n";
echo "Splits:\n" . var_export($timer->getSplits(), true);
