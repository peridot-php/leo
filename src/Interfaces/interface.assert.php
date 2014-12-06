<?php
/**
 * Include defintions for the assert style interface.
 *
 * @var Peridot\Leo\Responder\ResponderInterface $responder
 * @var Peridot\Leo\Interfaces\AssertInterface $this
 */

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EqualMatcher;

$this->addMethod('equal', function ($actual, $expected, $message = "") {
    $matcher = new EqualMatcher($expected);
    $match = $matcher->match($actual);
    $this->responder->respond($match, $matcher->getTemplate(), $message);
});

$this->addMethod('notEqual', function ($actual, $expected, $message = "") {
    $matcher = new EqualMatcher($expected);
    $match = $matcher->invert()->match($actual);
    $this->responder->respond($match, $matcher->getTemplate(), $message);
});

$this->addMethod('throws', function (callable $fn, $exceptionType, $exceptionMessage = "", $message = "") {
    $assertion = new Assertion($this->responder);
    $assertion->setActual($fn);
    $assertion->to->throw($exceptionType, $exceptionMessage, $message);
});

$this->addMethod('doesNotThrow', function (callable $fn, $exceptionType, $exceptionMessage = "", $message = "") {
    $assertion = new Assertion($this->responder);
    $assertion->setActual($fn);
    $assertion->to->not->throw($exceptionType, $exceptionMessage, $message);
});

$this->addMethod('typeOf', function ($actual, $expected, $message = "") {
    $assertion = new Assertion($this->responder);
    $assertion->setActual($actual);
    $assertion->to->be->a($expected, $message);
});

$this->addMethod('notTypeOf', function ($actual, $expected, $message = "") {
    $assertion = new Assertion($this->responder);
    $assertion->setActual($actual);
    $assertion->to->not->be->a($expected, $message);
});
