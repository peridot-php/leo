<?php
describe('->false()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->false(true);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert(!is_null($exception), "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "custom user message";
        try {
            $this->subject->false(true, $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });

    context('and assert method begins with not', function() {
        it('should throw an exception when the match succeeds', function() {
            $exception = null;
            try {
                $this->subject->notFalse(false);
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "should not have been {$exception->getMessage()}");
        });
    });
});
