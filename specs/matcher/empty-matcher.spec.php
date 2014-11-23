<?php
use Peridot\Leo\Matcher\EmptyMatcher;

describe('EmptyMatcher', function() {
    beforeEach(function() {
        $this->matcher = new EmptyMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for empty value', function() {
            $this->matcher->setSubject("");
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, "should not have matched empty value");
        });

        it('should return false for non-empty value', function() {
            $this->matcher->setSubject([1,2,3]);
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, "should not have matched for non-empty value");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected value to be empty";
            $actual = $this->matcher->getMessage(null, null, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected value to not be empty";
                $actual = $this->matcher->getMessage(null, null, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
