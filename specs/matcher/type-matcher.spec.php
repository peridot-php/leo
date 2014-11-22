<?php
use Peridot\Leo\Interfaces\Assert;
use Peridot\Leo\Matcher\TypeMatcher;

describe('TypeMatcher', function() {
    beforeEach(function() {
        $this->matcher = new TypeMatcher();
        $this->matcher->setSubject([]);
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected array, got string";
            $actual = $this->matcher->getMessage("array", "string");
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected a type other than array";
                $actual = $this->matcher->getMessage("array", "array", true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

    describe('->isMatch()', function() {
        it('should return true when subject is expected value', function() {
            $match = $this->matcher->isMatch('array');
            assert($match, "should have matched array type");
        });

        it('should return false when the subject is not expected value', function() {
            $match = $this->matcher->isMatch('string');
            assert(!$match, "should not have matched string type");
        });
    });
});
