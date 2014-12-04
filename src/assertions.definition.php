<?php
/**
 * Main definition for Assertion. Define methods and properties here.
 *
 * @var Peridot\Leo\Assertion $this
 */

use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;

$this->addMethod('equal', function($expected) {
    return new SameMatcher($expected);
});

$this->addMethod('throw', function($exceptionType, $exceptionMessage = '') {
    $matcher = new ExceptionMatcher($exceptionType);
    $matcher->setExpectedMessage($exceptionMessage);
    $matcher->setArguments($this->getArguments());
    return $matcher;
});
