<?php

use Peridot\Leo\Interfaces\Assert;

describe('Assert', function() {

    beforeEach(function() {
        $this->interface = new Assert([]);
    });

    include __DIR__ . '/../shared/is-interface.php';

    describe('->typeOf()', function() {
        it('should throw an exception when match fails', function() {
            $exception = null;
            try {
                $this->interface->typeOf([], 'string');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
        });

        it('should allow an optional user message', function() {
            $exception = null;
            $expected = "should have been a string";
            try {
                $this->interface->typeOf([], 'string', $expected);
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
        });
    });

    context('and assert method begins with not', function() {
        it('should throw an exception when the match succeeds', function() {
            $exception = null;
            try {
                $this->interface->notTypeOf([], 'array');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == "Expected a type other than array", "should not have been {$exception->getMessage()}");
        });
    });
});
