<?php
/**
 * Include defintions for the assert style interface.
 *
 * @var Peridot\Leo\Responder\ResponderInterface $responder
 * @var Peridot\Leo\Interfaces\AssertInterface $this
 */

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EqualMatcher;

$this->addMethod('equal', function($actual, $expected) use ($responder)  {
    $matcher = new EqualMatcher($expected);
    $match = $matcher->match($actual);
    $responder->respond($match, $matcher->getTemplate());
});

$this->addMethod('throws', function(callable $fn, $exceptionType, $exceptionMessage = "") use ($responder) {
    $assertion = new Assertion($responder, $fn);
    $assertion->to->throw($exceptionType, $exceptionMessage);
});
