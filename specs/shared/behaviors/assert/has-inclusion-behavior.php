<?php
describe('->contain()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->contain(['hello', 'world'], 'goodbye');
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert(!is_null($exception), "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "should have been included";
        try {
            $this->subject->contain(['hello'], 'world', $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });

    context('and assert method begins with not', function() {
        it('should throw an exception when the match succeeds', function() {
            $exception = null;
            try {
                $this->subject->notInclude(['hello'], 'hello');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "should not have been {$exception->getMessage()}");
        });
    });
});
