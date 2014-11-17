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

        context('when subject is a string', function() {
            beforeEach(function() {
                $this->interface->getSubject()->willReturn('hello');
            });

            it('should return true if item is in string', function() {
                $match = $this->matcher->isMatch('ell');
                assert($match, "should have found 'ell' substring");
            });

            it('should return false if item is not in string', function() {
                $match = $this->matcher->isMatch('beep');
                assert(!$match, "should not have found 'beep' substring");
            });
        });
    });

    describe('->getMessage()', function() {
        it('should return a formatted success message', function() {
            $message = $this->matcher->getMessage(1, 'array');
            assert($message == "Expected array to contain 1", "should have formatted success message");
        });

        context('when message is negated', function() {
            it('should return a formatted negated message', function() {
                $message = $this->matcher->getMessage(1, 'string', true);
                assert($message == "Expected string not to contain 1", "should have formatted negated message");
            });
        });
    });
});
