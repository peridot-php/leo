<?php
use Peridot\Leo\Subject;

describe('Subject', function () {
    describe('actual value', function () {

        beforeEach(function() {
            $this->subject = new Subject("actual");
        });

        it('should be accessible', function () {
            $this->subject->setActual("hello");
            $actual = $this->subject->getActual();
            assert($actual == "hello", "expected 'hello', got '$actual'");
        });
    });
});
