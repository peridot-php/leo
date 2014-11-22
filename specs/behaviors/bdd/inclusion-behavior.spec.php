<?php
use Peridot\Leo\Behavior\Bdd\InclusionBehavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\InclusionMatcher;

describe('Bdd\InclusionBehavior', function() {

    beforeEach(function() {
        $matcher = new InclusionMatcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([1,2,3]);
        $this->subject = new InclusionBehavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-inclusion-behavior.php';
});
