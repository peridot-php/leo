<?php
use Peridot\Leo\Matcher\EqualMatcher;

describe('EqualMatcher', function() {

    beforeEach(function() {
        $this->expected = 4;
        $this->matcher = new EqualMatcher($this->expected);
    });

    describe('->match()', function() {
        it('should return true result if actual value is the loosely equal to expected', function() {
            expect($this->matcher->match('4')->isMatch())->to->equal(true);
        });

        context('when inverted', function() {
            it('should return false result if actual value is loosely equal to expected', function() {
                expect($this->matcher->invert()->match($this->expected)->isMatch())->to->equal(false);
            });
        });
    });

});
