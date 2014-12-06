<?php
use Peridot\Leo\Matcher\TruthyMatcher;

describe('TruthyMatcher', function() {
    beforeEach(function() {
        $this->matcher = new TruthyMatcher();
    });

    it('should return true for a truthy value', function() {
        $match = $this->matcher->match([1,2,3]);
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false for a falsy value', function() {
        $match = $this->matcher->match(null);
        expect($match->isMatch())->to->equal(false);
    });

    context('when negated', function() {
        it('should return false when value is truthy', function() {
            $match = $this->matcher->invert()->match([1,2,3]);
            expect($match->isMatch())->to->equal(false);
        });
    });
});
