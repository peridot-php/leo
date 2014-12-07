<?php
use Peridot\Leo\Matcher\LessThanOrEqualMatcher;

describe('LessThanOrEqualMatcher', function() {

    beforeEach(function() {
        $this->matcher = new LessThanOrEqualMatcher(3);
    });

    it('should return true if actual value is at most expected', function() {
        $match = $this->matcher->match(3);
        expect($match->isMatch())->to->be->true;
    });

    it('should return false if actual value is more than expected', function() {
        $match = $this->matcher->match(5);
        expect($match->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('should return false if actual value is at most expected', function() {
            $match = $this->matcher->invert()->match(3);
            expect($match->isMatch())->to->be->false;
        });
    });
});
