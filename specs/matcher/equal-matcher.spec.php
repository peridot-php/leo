<?php
use Peridot\Leo\Matcher\EqualMatcher;

describe('EqualMatcher', function() {
    beforeEach(function() {
        $this->subject = new stdClass();
        $this->matcher = new EqualMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for same object', function() {
            $this->matcher->setSubject($this->subject);
            $isMatch = $this->matcher->isMatch($this->subject);
            assert($isMatch, "should have matched same object");
        });

        it('should return false for different object', function() {
            $this->matcher->setSubject(new stdClass());
            $isMatch = $this->matcher->isMatch($this->subject);
            assert(!$isMatch, "should not match different objects");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected values to be the same";
            $actual = $this->matcher->getMessage(null, null, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected values to be different";
                $actual = $this->matcher->getMessage(null, null, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
