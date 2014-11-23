<?php
use Peridot\Leo\Behavior\Assert\TrueBehavior;
use Peridot\Leo\Matcher\TrueMatcher;

describe('Assert\TrueBehavior', function() {

    beforeEach(function() {
        $matcher = new TrueMatcher();
        $this->subject = new TrueBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-true-behavior.php';
});
