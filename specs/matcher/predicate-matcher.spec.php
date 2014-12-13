<?php
use Peridot\Leo\Matcher\PredicateMatcher;

describe('PredicateMatcher', function() {

    beforeEach(function() {
        $this->matcher = new PredicateMatcher(function($num) {
            return $num > 1;
        });
    });

    it('should return true if actual value satisfies callable', function() {
        $result = $this->matcher->match(2);
        expect($result->isMatch())->to->be->true;
    });

    it('should return false if actual value does not satisfy callable', function() {
        $result = $this->matcher->match(1);
        expect($result->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('return false if actual value satisfies callable', function() {
            $result = $this->matcher->invert()->match(2);
            expect($result->isMatch())->to->be->false;
        });
    });
});
