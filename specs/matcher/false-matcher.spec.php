<?php
use Peridot\Leo\Matcher\FalseMatcher;

describe('FalseMatcher', function() {
    beforeEach(function() {
        $this->matcher = new FalseMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for false', function() {
            $this->matcher->setSubject(false);
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, "should match for false");
        });

        it('should return false for anything other than false', function() {
            $this->matcher->setSubject([]);
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, "should not match non false value");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected value to be false";
            $actual = $this->matcher->getMessage(null, null, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected value to not be false";
                $actual = $this->matcher->getMessage(null, null, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
