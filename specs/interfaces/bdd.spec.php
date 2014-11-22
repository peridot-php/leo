<?php
use Peridot\Leo\Interfaces\Bdd;

describe('Bdd', function() {

    beforeEach(function() {
        $this->interface = new Bdd([]);
        $this->subject = $this->interface;
    });

    include __DIR__ . '/../shared/is-interface.php';
    include __DIR__ . '/../shared/is-bdd-interface.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-type-behavior.php';

    describe('->not', function() {
        it('should set the negated flag and return self', function() {
            $scope = $this->interface->not;
            assert($scope === $this->interface, "should return self");
            assert($scope->isNegated(), "scope should be negated");
        });

        describe('->an()', function() {
            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->a('array');
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected a type other than array", "should not have been {$exception->getMessage()}");
            });
        });
    });

    describe('->include()', function() {
        it('should throw exception when match fails', function() {
            $exception = null;
            try {
                $this->subject->include(4);
            } catch (Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "exception should have been thrown");
        });

        context('and subject has been negated', function() {
            beforeEach(function() {
                $this->subject = new Bdd([1,2,3]);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->subject->not->include(1);
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected array not to contain 1", "should not have been {$exception->getMessage()}");
            });
        });
    });
});
