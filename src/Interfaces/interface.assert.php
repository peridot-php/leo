<?php
/**
 * Include defintions for the assert style interface.
 *
 * @var Peridot\Leo\Interfaces\AssertInterface $this
 */

use Peridot\Leo\Matcher\EqualMatcher;

$this->addMethod('equal', function ($actual, $expected, $message = "") {
    $matcher = new EqualMatcher($expected);
    $this->assertion
        ->flag('message', $message)
        ->setActual($actual)
        ->assert($matcher);
});

$this->addMethod('notEqual', function ($actual, $expected, $message = "") {
    $matcher = new EqualMatcher($expected);
    $matcher->invert();
    $this->assertion
        ->flag('message', $message)
        ->setActual($actual)
        ->assert($matcher);
});

$this->addMethod('throws', function (callable $fn, $exceptionType, $exceptionMessage = "", $message = "") {
    $this->assertion->setActual($fn);
    $this->assertion->to->throw($exceptionType, $exceptionMessage, $message);
});

$this->addMethod('doesNotThrow', function (callable $fn, $exceptionType, $exceptionMessage = "", $message = "") {
    $this->assertion->setActual($fn);
    $this->assertion->to->not->throw($exceptionType, $exceptionMessage, $message);
});

$this->addMethod('typeOf', function ($actual, $expected, $message = "") {
    $this->assertion->setActual($actual);
    $this->assertion->to->be->a($expected, $message);
});

$this->addMethod('notTypeOf', function ($actual, $expected, $message = "") {
    $this->assertion->setActual($actual);
    $this->assertion->to->not->be->a($expected, $message);
});
