<?php
use Peridot\Leo\Matcher\NullMatcher;

describe('NullMatcher', function() {
    beforeEach(function() {
        $this->matcher = new NullMatcher();
    });

    it('should return true for null', function() {
        $match = $this->matcher->match(null);
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false for not null', function() {
        $match = $this->matcher->match('true');
        expect($match->isMatch())->to->equal(false);
    });

    context('when negated', function() {
        it('should return false when value is null', function() {
            $match = $this->matcher->invert()->match(null);
            expect($match->isMatch())->to->equal(false);
        });
    });
});
