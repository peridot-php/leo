<?php

use Peridot\Leo\Interfaces\Assert;

describe('Assert', function() {

    beforeEach(function() {
        $this->interface = new Assert([]);
        $this->subject = $this->interface;
    });

    include __DIR__ . '/../shared/is-interface.php';

    include __DIR__ . '/../shared/behaviors/assert/has-type-behavior.php';
    include __DIR__ . '/../shared/behaviors/assert/has-inclusion-behavior.php';
    include __DIR__ . '/../shared/behaviors/assert/has-ok-behavior.php';
    include __DIR__ . '/../shared/behaviors/assert/has-true-behavior.php';
    include __DIR__ . '/../shared/behaviors/assert/has-false-behavior.php';
    include __DIR__ . '/../shared/behaviors/assert/has-null-behavior.php';

    context('when using a non-empty subject', function() {

        beforeEach(function() {
            $this->interface = new Assert([1,2,3]);
            $this->subject = $this->interface;
        });

        include __DIR__ . '/../shared/behaviors/assert/has-empty-behavior.php';

        describe('->empty()', function() {
            it('should throw an exception when match fails', function() {
                $exception = null;
                try {
                    $this->subject->empty(['hello', 'world']);
                } catch (\Exception $e) {
                    $exception = $e;
                }
                assert(!is_null($exception), "should not have been {$exception->getMessage()}");
            });
        });
    });

    describe('->include()', function() {
        it('should throw an exception when match fails', function() {
            $exception = null;
            try {
                $this->subject->include(['hello', 'world'], 'goodbye');
            } catch (\Exception $e) {
                $exception = $e;
            }
            assert(!is_null($exception), "should not have been {$exception->getMessage()}");
        });
    });
});
