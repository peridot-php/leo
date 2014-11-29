<?php
use Peridot\Leo\Matcher\SameMatcher;

describe('SameMatcher', function() {
    beforeEach(function() {
        $this->expected = new stdClass;
        $this->matcher = new SameMatcher($this->expected);
    });

    describe('->match()', function() {
        it('should return true result if actual value is the same as expected', function() {
            expect($this->matcher->match($this->expected)->isMatch())->to->equal(true);
        });

        context('when inverted', function() {
            it('should return false result if actual value is the same as expected', function() {
                expect($this->matcher->invert()->match($this->expected)->isMatch())->to->equal(false);
            });
        });
    });
});
