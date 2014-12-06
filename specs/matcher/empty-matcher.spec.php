<?php
use Peridot\Leo\Matcher\EmptyMatcher;

describe('NullMatcher', function() {
    beforeEach(function() {
        $this->matcher = new EmptyMatcher();
    });

    it('should return true for empty value', function() {
        $match = $this->matcher->match([]);
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false for non empty value', function() {
        $match = $this->matcher->match([1,2,3]);
        expect($match->isMatch())->to->equal(false);
    });

    context('when negated', function() {
        it('should return false when value is empty', function() {
            $match = $this->matcher->invert()->match([]);
            expect($match->isMatch())->to->equal(false);
        });
    });
});
