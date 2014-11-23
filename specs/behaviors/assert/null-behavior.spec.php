<?php
use Peridot\Leo\Behavior\Assert\NullBehavior;
use Peridot\Leo\Matcher\NullMatcher;

describe('Assert\NullBehavior', function() {

    beforeEach(function() {
        $matcher = new NullMatcher();
        $this->subject = new NullBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-null-behavior.php';
});
