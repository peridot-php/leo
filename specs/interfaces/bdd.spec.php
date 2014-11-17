<?php
use Peridot\Leo\Interfaces\Bdd;

describe('Bdd', function() {

    beforeEach(function() {
        $this->interface = new Bdd([]);
    });

    include __DIR__ . '/../shared/is-interface.php';
    include __DIR__ . '/../shared/is-bdd-interface.php';

    context('when ->not is accessed', function() {
        it('should set the negated flag and return self', function() {
            $scope = $this->interface->not;
            assert($scope === $this->interface, "should return self");
            assert($scope->isNegated(), "scope should be negated");
        });
    });

    describe('->a()', function() {
        it('should throw an exception when match fails', function() {
            $exception = null;
            try {
                $this->interface->setSubject([])->a('string');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
        });

        it('should allow an optional user message', function() {
            $exception = null;
            $expected = "should have been a string";
            try {
                $this->interface->setSubject([])->a('string', $expected);
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == $expected, "should not have been {$exception->getMessage()}");
        });

        context('and interface has been negated', function() {
            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->setSubject([])->not->a('array');
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
                $this->interface->setSubject([])->an('string');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert($exception->getMessage() == "Expected string, got array", "should not have been {$exception->getMessage()}");
        });
    });

    context('when using "a" as a language chain', function() {
        it("should return the interface", function() {
            $interface = $this->interface->a;
            assert($interface === $this->interface, "a as language chain should return interface");
        });
    });

    context('when using "an" as a language chain', function() {
        it("should return the TypeMatcher's parent", function() {
            $interface = $this->interface->an;
            assert($interface === $this->interface, "an as language chain should return interface");
        });
    });
});
