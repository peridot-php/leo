<?php
use Peridot\Leo\Assertion;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Responder\ExceptionResponder;

describe('Leo', function() {
    beforeEach(function() {
        $this->reflection = new ReflectionClass('Peridot\Leo\Leo');
        $leo = $this->reflection->newInstanceWithoutConstructor();
        $construct = $this->reflection->getConstructor();
        $construct->setAccessible(true);
        $construct->invoke($leo);
        $this->leo = $leo;
    });

    describe('formatter accessors', function() {
        it('should allow access to the formatter', function() {
            $formatter = new Formatter();
            $this->leo->setFormatter($formatter);
            expect($this->leo->getFormatter())->to->equal($formatter);
        });
    });

    describe('responder accessors', function() {
        it('should allow access to the responder', function() {
            $formatter = new Formatter();
            $responder = new ExceptionResponder($formatter);
            $this->leo->setResponder($responder);
            expect($this->leo->getResponder())->to->equal($responder);
        });
    });

    describe('assertion accessors', function() {
        it('should allow access to the assertion', function() {
            $formatter = new Formatter();
            $responder = new ExceptionResponder($formatter);
            $assertion = new Assertion($responder);
            $this->leo->setAssertion($assertion);
            expect($this->leo->getAssertion())->to->equal($assertion);
        });
    });
});
