<?php
use Peridot\Leo\Assertion;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Responder\ExceptionResponder;

describe('Assertion', function() {
    beforeEach(function() {
        $formatter = new Formatter();
        $this->responder = new ExceptionResponder($formatter);
    });

    context('when calling a dynamic method', function() {
        beforeEach(function() {
            $this->assertion = new Assertion($this->responder, 'actual');
            $this->assertion->addMethod('dynamicmethod', function($expected) {
                return new SameMatcher($expected);
            });
            $this->assertion->addMethod('nonmatcher', function($expected) {
                return $expected;
            });
        });

        it('should throw an exception if method does not exist', function() {
            expect([$this->assertion, 'notamethod'])->to->throw('BadMethodCallException');
        });

        it('should throw an exception if the method does not return a matcher', function() {
            expect([$this->assertion, 'nonmatcher'])->to->throw('RuntimeException');
        });
    });
});
