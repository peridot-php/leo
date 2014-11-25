<?php
use Peridot\Leo\Behavior\Bdd\EqualBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\EqualMatcher;

describe('Bdd\EqualBehavior', function() {

    beforeEach(function() {
        $matcher = new EqualMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new EqualBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-equal-behavior.php';
});
