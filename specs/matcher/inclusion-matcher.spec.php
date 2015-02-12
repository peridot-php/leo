<?php

use Peridot\Leo\Matcher\InclusionMatcher;

describe('InclusionMatcher', function() {

    beforeEach(function() {
        $this->matcher = new InclusionMatcher('A');
    });

    it('should throw an exception if actual value is not array or string', function() {
        expect([$this->matcher, 'match'])->with(5)->to->throw('InvalidArgumentException');
    });

    it('should return true if value is in array', function() {
        $match = $this->matcher->match(['A', 'B', 'C']);
        expect($match->isMatch())->to->equal(true);
    });

    it('should return true if value is in an instance of ArrayAccess', function() {
        $match = $this->matcher->match(new ArrayObject(['A', 'B', 'C']));
        expect($match->isMatch())->to->equal(true);
    });

    it('should return true if value is in string', function() {
        $match = $this->matcher->match('A pleasure to meet you');
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false if value is not in array', function() {
        $match = $this->matcher->match(['B', 'C', 'D']);
        expect($match->isMatch())->to->equal(false);
    });

    it('should return false if types are different', function() {
        $matcher = new InclusionMatcher('1');
        $match = $matcher->match([1]);
        expect($match->isMatch())->to->equal(false);
    });

    it('should return true if value is not in an instance of ArrayAccess', function() {
        $match = $this->matcher->match(new ArrayObject(['B', 'C', 'D']));
        expect($match->isMatch())->to->equal(true);
    });

    it('should return false if value is not in string', function() {
        $match = $this->matcher->match('The pleasure is all mine');
        expect($match->isMatch())->to->equal(false);
    });

    context('when negated', function() {
        it('should return false if value is included', function() {
            $match = $this->matcher->invert()->match(['A']);
            expect($match->isMatch())->to->equal(false);
        });
    });
});
