<?php
use Peridot\Leo\Behavior\Assert\InclusionBehavior;
use Peridot\Leo\Matcher\InclusionMatcher;

describe('Assert\InclusionBehavior', function() {

    beforeEach(function() {
        $matcher = new InclusionMatcher();
        $this->subject = new InclusionBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-inclusion-behavior.php';
});
