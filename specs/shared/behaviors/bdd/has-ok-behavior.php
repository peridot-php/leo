<?php
describe('->ok()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->ok();
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == "Expected value to be truthy", "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "should have been truthy";
        try {
            $this->subject->ok($expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });
});
