<?php
use Peridot\Leo\Matcher\GreaterThanMatcher;

describe('GreaterThanMatcher', function() {

    beforeEach(function() {
        $this->matcher = new GreaterThanMatcher(5);
    });

    it('should throw an exception if actual value is not numeric', function() {
        expect([$this->matcher, 'match'])->with('string')->to->throw('InvalidArgumentException');
    });

    it('should return true if actual value is greater than expected', function() {
        $match = $this->matcher->match(6);
        expect($match->isMatch())->to->be->true;
    });

    it('should return false if actual value is less than expected', function() {
        $match = $this->matcher->match(4);
        expect($match->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('should return false if actual value is above expected', function() {
            $match = $this->matcher->invert()->match(6);
            expect($match->isMatch())->to->be->false;
        });
    });

    context('when countable is set', function() {
        beforeEach(function() {
            $this->matcher->setCountable([1,2,3,4,5,6]);
        });

        it('should match true when countable length is above expected', function() {
            $match = $this->matcher->match();
            expect($match->isMatch())->to->be->true;
        });

        it('should match false when countable length is below expected', function() {
            $match = $this->matcher->setCountable([1,2])->match();
            expect($match->isMatch())->to->be->false;
        });

        context('and matcher is negated', function() {
            it('should return false if actual value is above expected', function() {
                $match = $this->matcher->invert()->match();
                expect($match->isMatch())->to->be->false;
            });
        });
    });

    describe('->getCountable()', function() {
        it('should fetch the countable', function() {
            $countable = [1,2,3];
            $this->matcher->setCountable($countable);
            expect($this->matcher->getCountable())->to->equal($countable);
        });
    });
});
