<?php
use Peridot\Leo\Matcher\LessThanMatcher;

describe('LessThanMatcher', function() {

    beforeEach(function() {
        $this->matcher = new LessThanMatcher(5);
    });

    it('should return true if actual value is less than expected', function() {
        $match = $this->matcher->match(4);
        expect($match->isMatch())->to->be->true;
    });

    it('should return false if actual value is greater than expected', function() {
        $match = $this->matcher->match(6);
        expect($match->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('should return false if actual value is below expected', function() {
            $match = $this->matcher->invert()->match(4);
            expect($match->isMatch())->to->be->false;
        });
    });
});
