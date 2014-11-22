<?php
use Peridot\Leo\Behavior\Assert\OkBehavior;
use Peridot\Leo\Matcher\OkMatcher;

describe('Assert\OkBehavior', function() {

    beforeEach(function() {
        $matcher = new OkMatcher();
        $this->subject = new OkBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-ok-behavior.php';
});
