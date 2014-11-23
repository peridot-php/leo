<?php
use Peridot\Leo\Behavior\Bdd\EmptyBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\EmptyMatcher;

describe('Bdd\EmptyBehavior', function() {

    beforeEach(function() {
        $matcher = new EmptyMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([1,2,3]);
        $this->subject = new EmptyBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-empty-behavior.php';
});
