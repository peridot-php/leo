<?php
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Interfaces\AssertInterface;
use Peridot\Leo\Responder\ExceptionResponder;

describe('assert', function() {
    beforeEach(function() {
        $this->assert = new AssertInterface();
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

    describe('->typeOf()', function() {
        it('should throw an exception if actual type and expected type are different', function() {
            $this->assert->throws(function() {
                $this->assert->typeOf(new stdClass(), "string");
            }, 'Exception', 'Expected "string", got "object"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->typeOf(new stdClass(), "string", 'wrong type');
            }, 'Exception', 'wrong type');
        });
    });

    describe('->notTypeOf()', function() {
        it('should throw an exception if actual type and expected type are same', function() {
            $this->assert->throws(function() {
                $this->assert->notTypeOf(new stdClass(), "object");
            }, 'Exception', 'Expected a type other than "object"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notTypeOf(new stdClass(), "object", "same type");
            }, 'Exception', 'same type');
        });
    });

    describe('->ok()', function() {
        it('should throw an exception if actual value is not truthy', function() {
            $this->assert->throws(function() {
                $this->assert->ok(false);
            }, 'Exception', 'Expected false to be truthy');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->ok(false, 'not ok');
            }, 'Exception', 'not ok');
        });
    });

    describe('->notOk()', function() {
        it('should throw an exception if actual value is truthy', function() {
            $this->assert->throws(function() {
                $this->assert->notOk(true);
            }, 'Exception', 'Expected true to be falsy');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notOk(true, 'is ok');
            }, 'Exception', 'is ok');
        });
    });

    describe('->strictEqual()', function() {
        it('should throw an exception if actual value is not identical to expected value', function() {
            $this->assert->throws(function() {
                $this->assert->strictEqual("string", "other");
            }, 'Exception', 'Expected "other" to be identical to "string"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->strictEqual("string", "other", "not identical");
            }, 'Exception', 'not identical');
        });
    });

    describe('->notStrictEqual()', function() {
        it('should throw an exception if actual value is identical to expected value', function() {
            $this->assert->throws(function() {
                $this->assert->notStrictEqual("string", "string");
            }, 'Exception', 'Expected "string" not to be identical to "string"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notStrictEqual("string", "string", "is identical");
            }, 'Exception', 'is identical');
        });
    });
});
