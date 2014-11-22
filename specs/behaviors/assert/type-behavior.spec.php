<?php
use Peridot\Leo\Behavior\Assert\TypeBehavior;
use Peridot\Leo\Matcher\TypeMatcher;

describe('Assert\TypeBehavior', function() {

    beforeEach(function() {
        $matcher = new TypeMatcher();
        $this->subject = new TypeBehavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-type-behavior.php';
});
