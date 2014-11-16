<?php

use Evenement\EventEmitterInterface;
use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Peridot\Plugin\Watcher\WatcherPlugin;
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

    $prophecy = new ProphecyPlugin($emitter);
};
