<?php
use Peridot\Leo\Matcher\OkMatcher;

describe('OkMatcher', function() {
    beforeEach(function() {
        $this->matcher = new OkMatcher();
    });

    describe('->isMatch()', function() {
        it('should return true for a truthy value', function() {
            $this->matcher->setSubject('non empty string');
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, 'should match truthy value');
        });

        it('should return false for a falsey value', function() {
            $this->matcher->setSubject([]);
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, "should not match falsey value");
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = "Expected value to be truthy";
            $actual = $this->matcher->getMessage(null, [], false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected value to not be truthy";
                $actual = $this->matcher->getMessage(null, [], true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
