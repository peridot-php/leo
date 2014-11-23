<?php
use Peridot\Leo\Behavior\Bdd\NullBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\NullMatcher;

describe('Bdd\NullBehavior', function() {

    beforeEach(function() {
        $matcher = new NullMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new NullBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-null-behavior.php';
});
