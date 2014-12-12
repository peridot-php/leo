<?php
use Peridot\Leo\Matcher\LengthMatcher;

describe('LengthMatcher', function() {
    beforeEach(function() {
        $this->matcher = new LengthMatcher(2);
    });

    describe('->match()', function() {
        context('when matching an array', function() {
            it('should return true if the array has the expected length', function() {
                $result = $this->matcher->match([1,2]);
                expect($result->isMatch())->to->be->true;
            });

            it('should return false if the array does not have the expected length', function() {
                $result = $this->matcher->match([1]);
                expect($result->isMatch())->to->be->false;
            });

            context('and is negated', function() {
                it('should return false if the array has the expected length', function() {
                    $result = $this->matcher->invert()->match([1,2]);
                    expect($result->isMatch())->to->be->false;
                });
            });
        });

        context('when matching a string', function() {
            it('should return true if the string has the expected length', function() {
                $result = $this->matcher->match('hi');
                expect($result->isMatch())->to->be->true;
            });

            it('should return false if the string does not have the expected length', function() {
                $result = $this->matcher->match('h');
                expect($result->isMatch())->to->be->false;
            });

            context('and is negated', function() {
                it('should return false if the string has the expected length', function() {
                    $result = $this->matcher->invert()->match('hi');
                    expect($result->isMatch())->to->be->false;
                });
            });
        });

        it('should throw an exception if actual is not a countable or string', function() {
            expect([$this->matcher, 'match'])->with(123)->to->throw('InvalidArgumentException');
        });
    });
});
