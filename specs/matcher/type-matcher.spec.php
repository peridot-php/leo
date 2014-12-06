<?php
use Peridot\Leo\Matcher\TypeMatcher;

describe('TypeMatcher', function() {

    beforeEach(function() {
        $this->expected = "object";
        $this->matcher = new TypeMatcher($this->expected);
    });

    describe('->match()', function() {
        it('should return true result if actual value the same type as the expected', function() {
            expect($this->matcher->match(new stdClass())->isMatch())->to->equal(true);
        });

        context('when inverted', function() {
            it('should return false result if actual type and expected are the same', function() {
                expect($this->matcher->invert()->match(new stdClass())->isMatch())->to->equal(false);
            });
        });
    });

});
