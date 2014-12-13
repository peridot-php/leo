<?php
use Peridot\Leo\Matcher\PatternMatcher;

describe('PatternMatcher', function() {
    beforeEach(function() {
        $this->matcher = new PatternMatcher('/^hi/');
    });

    describe('->match()', function() {
        it('should return true if actual value matches expected pattern', function() {
            $result = $this->matcher->match('hihowareyou');
            expect($result->isMatch())->to->be->true;
        });

        it('should return false if actual value does not match expected pattern', function() {
            $result = $this->matcher->match('nope');
            expect($result->isMatch())->to->be->false;
        });

        it('should throw an exception if the actual value is not a string', function() {
            expect([$this->matcher, 'match'])->with(1)->to->throw('InvalidArgumentException');
        });

        context('when negated', function() {
            it('should return false if value does match pattern', function() {
                $result = $this->matcher->invert()->match('hithere');
                expect($result->isMatch())->to->be->false;
            });
        });
    });
});
