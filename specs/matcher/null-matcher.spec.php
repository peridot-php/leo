<?php
use Peridot\Leo\Matcher\NullMatcher;

describe('NullMatcher', function() {
    beforeEach(function() {
        $this->matcher = new NullMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for null', function() {
            $this->matcher->setSubject(null);
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, "should have matched null");
        });

        it('should return false for non null', function() {
            $this->matcher->setSubject([]);
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, "should not have matched non null");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected value to be null";
            $actual = $this->matcher->getMessage(null, null, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected value to not be null";
                $actual = $this->matcher->getMessage(null, null, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
