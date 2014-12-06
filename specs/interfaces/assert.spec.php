<?php
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Interfaces\AssertInterface;
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
            $this->assert->throws(function() {
                $this->assert->equal(4, 3);
            }, 'Exception');
        });

        it('should throw exception with a user supplied message', function() {
            $this->assert->throws(function() {
                $this->assert->equal(4, 3, 'not equal');
            }, 'Exception', 'not equal');
        });

        it('should throw a formatted exception message', function() {
            $this->assert->throws(function() {
                $this->assert->equal(4, 3);
            }, 'Exception', 'Expected 3, got 4');
        });
    });

    describe('->notEqual()', function() {
        it('should throw when both values are same', function() {
            $this->assert->throws(function() {
                $this->assert->notEqual(4, 4);
            }, 'Exception');
        });

        it('should throw a user supplied message', function() {
            $this->assert->throws(function() {
                $this->assert->notEqual(4, 4, 'should not be equal');
            }, 'Exception', 'should not be equal');
        });
    });

    describe('->throws', function() {
        it('should match a function that throws an exception', function() {
            $this->assert->throws(function() {
                throw new Exception("error");
            }, 'Exception');
        });

        it('should allow a user supplied assertion message', function() {
            $this->assert->throws(function() {
                $this->assert->throws(function() {
                    throw new DomainException('oops');
                }, 'RuntimeException', "", "failure");
            }, 'Exception', 'failure');
        });
    });

    describe('->doesNotThrow()', function() {
        it('should throw an exception if function throws exception', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception("failure");
                }, 'Exception');
            }, 'Exception');
        });

        it('should throw an exception if equal messages are thrown', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception('failure');
                }, 'RuntimeException', 'failure');
            }, 'Exception');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception('failure');
                }, 'RuntimeException', 'failure', 'oooooops');
            }, 'Exception', 'oooooops');
        });
    });
});
