<?php
use Peridot\Leo\AssertInterface;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Responder\ExceptionResponder;

describe('assert', function() {
    beforeEach(function() {
        $formatter = new Formatter();
        $responder = new ExceptionResponder($formatter);
        $this->assert = new AssertInterface($responder);
    });

    describe('->equal()', function() {
        it('should match to loosely equal values', function() {
            $this->assert->equal(3, '3');
        });

        it('should throw exception when values are not loosely equal', function() {
            $this->assert->with(4, 3)->throws([$this->assert, 'equal'], 'Exception');
        });

        it('should throw a formatted exception message', function() {
            $this->assert->with(4, 3)->throws([$this->assert, 'equal'], 'Exception', 'Expected 3, got 4');
        });
    });

    describe('->throws', function() {
        it('should match a function that throws an exception', function() {
            $this->assert->throws(function() {
                throw new Exception("error");
            }, 'Exception');
        });

        context('when calling using with language chain', function() {
            it('should pass args to callable', function() {
                $this->assert->with(1)->throws(function($x) {
                    if ($x == 1) {
                        throw new Exception("one thrown");
                    }
                }, 'Exception');
            });
        });
    });
});
