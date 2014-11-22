<?php
use Peridot\Leo\Matcher\{{name}}Matcher;

xdescribe('{{name}}Matcher', function() {
    beforeEach(function() {
        $this->matcher = new {{name}}Matcher();
    });

    describe('->isMatch()', function() {
        it('should return true for REPLACE ME', function() {
            $this->matcher->setSubject(SUBJECT);
            $isMatch = $this->matcher->isMatch();
            assert($isMatch, REPLACE_ME);
        });

        it('should return false for REPLACE ME', function() {
            $this->matcher->setSubject(SUBJECT);
            $isMatch = $this->matcher->isMatch();
            assert(!$isMatch, REPLACE_ME);
        });
    });

    describe('->getMessage()', function() {
        it("should return a formatted success message", function() {
            $expected = EXPECTED_OUTPUT;
            $actual = $this->matcher->getMessage(EXPECTED, ACTUAL, false);
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = EXPECTED_OUTPUT;
                $actual = $this->matcher->getMessage(EXPECTED, ACTUAL, true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

});
