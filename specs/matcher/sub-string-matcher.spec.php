<?php
use Peridot\Leo\Matcher\SubStringMatcher;

describe('SubStringMatcher', function() {
    beforeEach(function() {
        $this->matcher = new SubStringMatcher('foo');
    });

    describe('->match()', function() {
        it('should return true if substring is contained in actual', function() {
            $result = $this->matcher->match('foobar');
            expect($result->isMatch())->to->be->true;
        });

        it('should return false if substring is not contained in actual', function() {
            $result = $this->matcher->match('hello');
            expect($result->isMatch())->to->be->false;
        });

        context('when negated', function() {
            it('should return false if substring is contained in actual', function() {
                $result = $this->matcher->invert()->match('foobar');
                expect($result->isMatch())->to->be->false;
            });
        });
    });
});
