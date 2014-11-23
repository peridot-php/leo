<?php
use Peridot\Leo\Behavior\Bdd\FalseBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\FalseMatcher;

describe('Bdd\FalseBehavior', function() {

    beforeEach(function() {
        $matcher = new FalseMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new FalseBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-false-behavior.php';
});
