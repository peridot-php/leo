<?php
use Peridot\Leo\Matcher\GreaterThanOrEqualMatcher;

describe('GreaterThanOrEqualMatcher', function() {

    beforeEach(function() {
        $this->matcher = new GreaterThanOrEqualMatcher(3);
    });

    it('should return true if actual value is at least expected', function() {
        $match = $this->matcher->match(3);
        expect($match->isMatch())->to->be->true;
    });

    it('should return false if actual value is less than expected', function() {
        $match = $this->matcher->match(2);
        expect($match->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('should return false if actual value is at least expected', function() {
            $match = $this->matcher->invert()->match(3);
            expect($match->isMatch())->to->be->false;
        });
    });
});
