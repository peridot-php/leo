<?php
use Peridot\Leo\Behavior\Bdd\OkBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\OkMatcher;

describe('Bdd\OkBehavior', function() {

    beforeEach(function() {
        $matcher = new OkMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new OkBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-ok-behavior.php';
});
