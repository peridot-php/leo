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
    include __DIR__ . '/../shared/behaviors/bdd/has-inclusion-behavior.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-ok-behavior.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-true-behavior.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-false-behavior.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-null-behavior.php';
    include __DIR__ . '/../shared/behaviors/bdd/has-equal-behavior.php';

    context('when using a non-empty subject', function() {

        beforeEach(function() {
            $this->interface = new Bdd([1,2,3]);
            $this->subject = $this->interface;
        });

        include __DIR__ . '/../shared/behaviors/bdd/has-empty-behavior.php';
    });

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

        describe('->ok()', function() {

            beforeEach(function() {
                $this->interface = new Bdd(true);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->ok();
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected value to not be truthy", "should not have been {$exception->getMessage()}");
            });
        });

        describe('->true()', function() {

            beforeEach(function() {
                $this->interface = new Bdd(true);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->true();
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected value to not be true", "should not have been {$exception->getMessage()}");
            });
        });

        describe('->false()', function() {

            beforeEach(function() {
                $this->interface = new Bdd(false);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->false();
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected value to not be false", "should not have been {$exception->getMessage()}");
            });
        });

        describe('->null()', function() {

            beforeEach(function() {
                $this->interface = new Bdd(null);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->null();
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected value to not be null", "should not have been {$exception->getMessage()}");
            });
        });

        describe('->equal()', function() {
            beforeEach(function() {
                $this->obj = new stdClass();
                $this->interface = new Bdd($this->obj);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->interface->not->equal($this->obj);
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected stdClass Object\n(\n) not to equal stdClass Object\n(\n)", "should not have been {$exception->getMessage()}");
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

    describe('->empty()', function() {

        beforeEach(function() {
            $this->subject = new Bdd([1,2,3]);
        });

        it('should throw exception when match fails', function() {
            $exception = null;
            try {
                $this->subject->empty();
            } catch (Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "exception should have been thrown");
        });

        context('and subject has been negated', function() {

            beforeEach(function() {
                $this->subject = new Bdd([]);
            });

            it('should throw an exception when the match succeeds', function() {
                $exception = null;
                try {
                    $this->subject->not->empty();
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert($exception->getMessage() == "Expected value to not be empty", "should not have been {$exception->getMessage()}");
            });
        });
    });
});
