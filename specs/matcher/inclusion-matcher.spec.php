<?php
use Peridot\Leo\Matcher\InclusionMatcher;

describe('InclusionMatcher', function() {
    beforeEach(function() {
        $this->interface = $this->getProphet()->prophesize('Peridot\Leo\Interfaces\AbstractBaseInterface');
        $this->matcher = new InclusionMatcher();
        $this->matcher->peridotSetParentScope($this->interface->reveal());
    });

    describe('->isMatch()', function() {
        context('when subject is not a string or array', function() {
            it('should throw an InvalidArgumentException', function() {
                $this->interface->getSubject()->willReturn(1);
                $exception = null;
                try {
                    $this->matcher->isMatch(1);
                } catch (InvalidArgumentException $e) {
                    $exception = $e;
                }
                assert(! is_null($exception), "expected exception to be thrown");
            });
        });

        context('when subject is an array', function() {
            it('should return true if item is in array', function() {
                $this->interface->getSubject()->willReturn([1,2,3]);
                $match = $this->matcher->isMatch(1);
                assert($match, "should have found 1 in array");
            });

            it('should return false if item is not in array', function() {
                $this->interface->getSubject()->willReturn([1,2,3]);
                $match = $this->matcher->isMatch(4);
                assert(!$match, "should not have found 4 in array");
            });
        });
    });
});
