<?php
use Peridot\Leo\Matcher\EqualMatcher;

describe('EqualMatcher', function() {

    beforeEach(function() {
        $this->expected = 4;
        $this->matcher = new EqualMatcher($this->expected);
    });

    describe('->match()', function() {
        it('should return true if actual value is the loosely equal to expected', function() {
            expect($this->matcher->match('4'))->to->equal(true);
        });

        context('when inverted', function() {
            it('should return false if actual value is loosely equal to expected', function() {
                expect($this->matcher->invert()->match($this->expected))->to->equal(false);
            });
        });
    });

});
