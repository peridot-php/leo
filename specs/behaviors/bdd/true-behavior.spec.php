<?php
use Peridot\Leo\Behavior\Bdd\TrueBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\TrueMatcher;

describe('Bdd\TrueBehavior', function() {

    beforeEach(function() {
        $matcher = new TrueMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new TrueBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-true-behavior.php';
});
