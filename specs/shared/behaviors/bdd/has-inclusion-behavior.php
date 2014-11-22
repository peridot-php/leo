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

context('when using contain as a language chain', function() {
    it('should enable the contain flag on interface and return interface', function() {
        $interface = $this->interface->contain;
        assert($interface === $this->interface, "should return interface");
        $flag = $this->interface->getFlag('contain');
        assert($flag->isEnabled(), "contain flag should be enabled");
    });
});

context('when using include as a language chain', function() {
    it('should enable the include flag on interface and return interface', function() {
        $interface = $this->interface->include;
        assert($interface === $this->interface, "should return interface");
        $flag = $this->interface->getFlag('include');
        assert($flag->isEnabled(), "include flag should be enabled");
    });
});
