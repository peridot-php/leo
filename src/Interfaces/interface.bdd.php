<?php

use Peridot\Leo\Assertion;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Responder\ExceptionResponder;

function expect($actual) {
    $formatter = new Formatter();
    $responder = new ExceptionResponder($formatter);
    $assertion = new Assertion($responder);
    return $assertion->setActual($actual);
}
