<?php
use Peridot\Leo\Interfaces\Bdd;
use Peridot\Leo\Matcher\TypeMatcher;

describe('TypeMatcher', function() {
    beforeEach(function() {
        $this->interface = new Bdd([]);
        $this->matcher = new TypeMatcher();
        $this->matcher->peridotSetParentScope($this->interface);
    });

    describe('->getMessage()', function() {
        it("should return a formated success message", function() {
            $expected = "Expected array, got string";
            $actual = $this->matcher->getMessage("array", "string");
            assert($expected == $actual, "Expected '$expected', got $actual");
        });

        context('when interface has been negated', function() {
            it('should return an appropriate message', function() {
                $expected = "Expected a type other than array";
                $actual = $this->matcher->getMessage("array", "array", true);
                assert($expected == $actual, "Expected $expected, got $actual");
            });
        });
    });

    describe('->isMatch()', function() {
        it('should return true when subject is expected value', function() {
            $match = $this->matcher->isMatch('array', 'array');
            assert($match, "should have matched array type");
        });

        it('should return false when the subject is not expected value', function() {
            $match = $this->matcher->isMatch('string', 'array');
            assert(!$match, "should not have matched string type");
        });
    });

    context('when interface is a Bdd interface', function() {
        describe('->a()', function() {
            it('should throw an exception when match fails', function() {
                $exception = null;
                try {
                    $this->interface->setSubject([]);
                    $this->matcher->a('string');
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
            });

            it('should allow an optional user message', function() {
                $exception = null;
                $expected = "should have been a string";
                try {
                    $this->interface->setSubject([]);
                    $this->matcher->a('string', $expected);
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
            });

            context('when interface has been negated', function() {
                it('should throw an exception when the match succeeds', function() {
                    $exception = null;
                    try {
                        $this->interface->setSubject([]);
                        $this->interface->negated = true;
                        $this->matcher->a('array');
                    } catch (\Exception $e) {
                        $exception = $e;
                    }
                    assert($exception->getMessage() == "Expected a type other than array", "should not have been {$exception->getMessage()}");
                });
            });
        });

        describe('->an()', function() {
            it('should throw an exception when match fails', function() {
                $exception = null;
                try {
                    $this->interface->setSubject([]);
                    $this->matcher->an('string');
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
            });
        });


        context('when using "a" as a language chain', function() {
            it("should return the TypeMatcher's parent", function() {
                $interface = $this->matcher->a;
                assert($interface === $this->interface, "a as language chain should return parent");
            });
        });

        context('when using "an" as a language chain', function() {
            it("should return the TypeMatcher's parent", function() {
                $interface = $this->matcher->an;
                assert($interface === $this->interface, "an as language chain should return parent");
            });
        });
    });
});
