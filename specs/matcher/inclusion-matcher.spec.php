<?php
use Peridot\Leo\Interfaces\Bdd;
use Peridot\Leo\Matcher\InclusionMatcher;

xdescribe('InclusionMatcher', function() {
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

    context('when interface is Bdd', function() {

        beforeEach(function() {
            $this->interface = new Bdd([]);
            $this->matcher->peridotSetParentScope($this->interface);
        });

        describe('->include()', function() {
            it('should throw exception when match fails', function() {
                $exception = null;
                try {
                    $this->interface->setSubject([1,2,3]);
                    $this->matcher->include(4);
                } catch (Exception $e) {
                    $exception = $e;
                }
                assert(!is_null($exception), "exception should have been thrown");
            });

            it('should allow an optional user message', function() {
                $exception = null;
                $expected = "should have been included";
                try {
                    $this->interface->setSubject([1,2,3]);
                    $this->matcher->include(4, $expected);
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
            });

            context('and interface has been negated', function() {
                it('should throw an exception when the match succeeds', function() {
                    $exception = null;
                    try {
                        $this->interface->setSubject([1,2,3]);
                        $this->interface->negated = true;
                        $this->matcher->include(1);
                    } catch (\Exception $e) {
                        $exception = $e;
                    }
                    assert($exception->getMessage() == "Expected array not to contain 1", "should not have been {$exception->getMessage()}");
                });
            });
        });

        describe('->contain()', function() {
            it('should throw exception when match fails', function() {
                $exception = null;
                try {
                    $this->interface->setSubject([1,2,3]);
                    $this->matcher->contain(4);
                } catch (Exception $e) {
                    $exception = $e;
                }
                assert(!is_null($exception), "exception should have been thrown");
            });
        });
    });
});
