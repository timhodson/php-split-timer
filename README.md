# PHP Split Timer

Time something that repeats—for example a series of API calls—and then get some averages, fastest and slowest times.

## Installation

Install with composer. 

Add this to your repositories:

```
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/timhodson/php-split-timer"
    }
]
```

Add this to your require: 

```
"require": {
  "timhodson/php-split-timer" : "0.1.0"
}
```

And run `php composer.phar install` or `php composer.phar update` in your project.

## Usage

```php
use SplitTimer\Timer;

$timer = new Timer();

for ($i=1; $i <= 10; $i++) {
    $timer->start(); // start the timer
    
    // do something highly useful
    echo "loop $i\n";
    sleep(rand((5/$i)+0.1, 5));
    
    $timer->split(); // stop the timer and record a split
}

// print out some results
echo "Mode: " . $timer->modeSplit() . " seconds\n";
echo "Mean: " . $timer->meanSplit() . " seconds\n";
echo "Fastest: " .$timer->fastest() . " seconds\n";
echo "Slowest: " . $timer->slowest() . " seconds\n";

```

## Development

We're using PSR-2 and linting with a pre-commit hook to check your files before you commit them.

If the pre-commit hook isn't working run `php composer.phar install` again.