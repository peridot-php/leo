<?php
use Peridot\Leo\Behavior\Assert\FalseBehavior;
use Peridot\Leo\Matcher\FalseMatcher;

describe('Assert\FalseBehavior', function() {

    beforeEach(function() {
        $matcher = new FalseMatcher();
        $this->subject = new FalseBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-false-behavior.php';
});
