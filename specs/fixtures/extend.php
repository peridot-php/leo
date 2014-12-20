<?php
use Peridot\Leo\Assertion;

return function(Assertion $assertion) {
    $assertion->addMethod('fixture', function () {
        return 5;
    });
};
