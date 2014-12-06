<?php
use Peridot\Leo\Matcher\TrueMatcher;

describe('TrueMatcher', function() {
    beforeEach(function() {
        $this->matcher = new TrueMatcher();
    });

    it('should return true for a true', function() {
        $match = $this->matcher->match(true);
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false for not true', function() {
        $match = $this->matcher->match('true');
        expect($match->isMatch())->to->equal(false);
    });

    context('when negated', function() {
        it('should return false when value is true', function() {
            $match = $this->matcher->invert()->match(true);
            expect($match->isMatch())->to->equal(false);
        });
    });
});
