<?php
use Peridot\Leo\Subject;

describe('Subject', function () {

    beforeEach(function() {
        $this->subject = new Subject("actual");
    });

    describe('actual value', function () {
        it('should be accessible', function () {
            $this->subject->setActual("hello");
            $actual = $this->subject->getActual();
            assert($actual == "hello", "expected 'hello', got '$actual'");
        });
    });
});
