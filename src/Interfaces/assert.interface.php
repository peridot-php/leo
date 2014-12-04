<?php
/**
 * Include defintions for the assert style interface.
 *
 * @var Peridot\Leo\Responder\ResponderInterface $responder
 * @var Peridot\Leo\Interfaces\AssertInterface $this
 */

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EqualMatcher;

$this->addMethod('equal', function($actual, $expected)  {
    $matcher = new EqualMatcher($expected);
    $match = $matcher->match($actual);
    $this->responder->respond($match, $matcher->getTemplate());
});

$this->addMethod('throws', function(callable $fn, $exceptionType, $exceptionMessage = "") {
    $assertion = new Assertion($this->responder, $fn);
    $assertion->to->throw($exceptionType, $exceptionMessage);
});
