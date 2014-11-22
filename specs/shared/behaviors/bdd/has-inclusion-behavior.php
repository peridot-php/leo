<?php
describe('->contain()', function() {
    it('should throw exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->contain(4);
        } catch (Exception $e) {
            $exception = $e;
        }
        assert(!is_null($exception), "exception should have been thrown");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "should have been included";
        try {
            $this->subject->contain(4, $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });
});
