<?php
describe('->a()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->a('string');
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
    });

    it('should allow an optional user message', function() {
        $exception = null;
        $expected = "should have been a string";
        try {
            $this->subject->a('string', $expected);
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
    });
});

describe('->an()', function() {
    it('should throw an exception when match fails', function() {
        $exception = null;
        try {
            $this->subject->an('string');
        } catch (\Exception $e) {
            $exception = $e;
        }
        assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
    });
});

context('when using "a" as a language chain', function() {
    it("should return the interface", function() {
        $interface = $this->subject->a;
        assert($interface === $this->interface, "a as language chain should return interface");
    });
});

context('when using "an" as a language chain', function() {
    it("should return the TypeMatcher's parent", function() {
        $interface = $this->subject->an;
        assert($interface === $this->interface, "an as language chain should return interface");
    });
});
