<?php
describe('->typeOf()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->typeOf([], 'string');
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "should have been a string";
        try {
            $this->subject->typeOf([], 'string', $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });

    context('and assert method begins with not', function() {
        it('should throw an exception when the match succeeds', function() {
            $exception = null;
            try {
                $this->subject->notTypeOf([], 'array');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == "Expected a type other than array", "should not have been {$exception->getMessage()}");
        });
    });
});
