<?php
use Peridot\Leo\Matcher\SameMatcher;

describe('SameMatcher', function() {

    beforeEach(function() {
        $this->expected = new stdClass;
        $this->matcher = new SameMatcher($this->expected);
    });

    describe('->match()', function() {
        it('should return true if actual value is the same as expected', function() {
            expect($this->matcher->match($this->expected))->to->equal(true);
        });

        context('when inverted', function() {
            it('should return false if actual value is the same as expected', function() {
                expect($this->matcher->invert()->match($this->expected))->to->equal(false);
            });
        });
    });

    describe('->invert()', function() {
        it('should toggle negated status', function() {
            expect($this->matcher->isNegated())->to->equal(false);
            $this->matcher->invert();
            expect($this->matcher->isNegated())->to->equal(true);
        });
    });

});
