<?php
use Peridot\Leo\Behavior\Assert\EmptyBehavior;
use Peridot\Leo\Matcher\EmptyMatcher;

describe('Assert\EmptyBehavior', function() {

    beforeEach(function() {
        $matcher = new EmptyMatcher();
        $this->subject = new EmptyBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-empty-behavior.php';
});
