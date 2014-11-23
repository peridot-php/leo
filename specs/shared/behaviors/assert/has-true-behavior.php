<?php
describe('->true()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->true(false);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert(!is_null($exception), "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "custom user message";
        try {
            $this->subject->true(false, $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });

    context('and assert method begins with not', function() {
        it('should throw an exception when the match succeeds', function() {
            $exception = null;
            try {
                $this->subject->notTrue(true);
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "should not have been {$exception->getMessage()}");
        });
    });
});
