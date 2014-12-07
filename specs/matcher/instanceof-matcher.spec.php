<?php
use Peridot\Leo\Matcher\InstanceofMatcher;

describe('InstanceofMatcher', function() {
    beforeEach(function() {
        $this->matcher = new InstanceofMatcher('stdClass');
    });

    it('should return true if object is instance of expected', function() {
        $result = $this->matcher->match(new stdClass());
        expect($result->isMatch())->to->be->true;
    });

    it('should return false if object is not instance of expected', function() {
        $result = $this->matcher->match([]);
        expect($result->isMatch())->to->be->false;
    });

    context('when negated', function() {
        it('should return false if object is instanceof expected', function() {
            $result = $this->matcher->invert()->match(new stdClass());
            expect($result->isMatch())->to->be->false;
        });
    });
});
