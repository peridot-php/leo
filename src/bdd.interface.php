<?php
use Peridot\Leo\BddInterface;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Responder\ExceptionResponder;

function expect($actual) {
    $formatter = new Formatter();
    $responder = new ExceptionResponder($formatter);
    return new BddInterface($responder, $actual);
}
