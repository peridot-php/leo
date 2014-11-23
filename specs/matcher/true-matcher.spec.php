<?php
use Peridot\Leo\Matcher\TrueMatcher;

describe('TrueMatcher', function() {
    beforeEach(function() {
        $this->matcher = new TrueMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for true', function() {
            $this->matcher->setSubject(true);
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, "expected true to be true");
        });

        it('should return false for anything other than true', function() {
            $this->matcher->setSubject("string");
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, "expected not to match true");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected value to be true";
            $actual = $this->matcher->getMessage(null, null, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected value to not be true";
                $actual = $this->matcher->getMessage(null, null, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
