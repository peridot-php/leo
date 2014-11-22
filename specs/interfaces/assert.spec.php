<?php

use Peridot\Leo\Interfaces\Assert;

describe('Assert', function() {

    beforeEach(function() {
        $this->interface = new Assert([]);
        $this->subject = $this->interface;
    });

    include __DIR__ . '/../shared/is-interface.php';

    include __DIR__ . '/../shared/behaviors/assert/has-type-behavior.php';

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
