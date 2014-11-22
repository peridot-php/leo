<?php
use Peridot\Leo\Behavior\Assert\{{name}}Behavior;
use Peridot\Leo\Matcher\{{name}}Matcher;

describe('Assert\{{name}}Behavior', function() {

    beforeEach(function() {
        $matcher = new {{name}}Matcher();
        $this->subject = new {{name}}Behavior($matcher);
    });

    include __DIR__ . '/../../shared/behaviors/assert/has-{{behavior}}-behavior.php';
});
