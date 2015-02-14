<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Peridot\Plugin\Watcher\WatcherPlugin;
use Peridot\Reporter\CodeCoverage\AbstractCodeCoverageReporter;
use Peridot\Reporter\CodeCoverageReporters;
use Peridot\Reporter\Dot\DotReporterPlugin;
use Peridot\Reporter\ListReporter\ListReporterPlugin;

return function(EventEmitterInterface $emitter) {
    $watcher = new WatcherPlugin($emitter);
    $watcher->track(__DIR__ . '/src');

    $dot = new DotReporterPlugin($emitter);
    $list = new ListReporterPlugin($emitter);

    $coverage = new CodeCoverageReporters($emitter);
    $coverage->register();

    $emitter->on('code-coverage.start', function(AbstractCodeCoverageReporter $reporter) {
        $reporter->addDirectoryToBlacklist(__DIR__ . '/vendor');
        $reporter->addDirectoryToBlacklist(__DIR__ . '/specs');
        $reporter->addFileToBlacklist(__DIR__ . '/peridot.php');
    });

    $prophecy = new ProphecyPlugin($emitter);

    $debug = getenv('DEBUG');

    if ($debug) {
        $emitter->on('error', function ($number, $message, $file, $line) {
            print "Error: $number - $message:$file:$line\n";
        });
    }
};

