<?php
use Peridot\Leo\Behavior\Bdd\TypeBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\TypeMatcher;

describe('TypeBehavior', function() {

    beforeEach(function() {
        $matcher = new TypeMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new TypeBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-type-behavior.php';
});
