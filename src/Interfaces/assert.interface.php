<?php
/**
 * @var Peridot\Leo\Responder\ResponderInterface $responder
 * @var Peridot\Leo\Interfaces\AssertInterface $interface
 */

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EqualMatcher;

$interface->addMethod('equal', function($actual, $expected) use ($responder)  {
    $matcher = new EqualMatcher($expected);
    $match = $matcher->match($actual);
    $responder->respond($match, $matcher->getTemplate());
});

$interface->addMethod('throws', function(callable $fn, $exceptionType, $exceptionMessage = "") use ($responder) {
    $assertion = new Assertion($responder, $fn);
    $assertion->to->throw($exceptionType, $exceptionMessage);
});
