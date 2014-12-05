<?php
/**
 * Main definition for Assertion. Define methods and properties here.
 *
 * @var Peridot\Leo\Assertion $this
 */

use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;

/**
 * Default language chains.
 */
$chains = [
    'to', 'be', 'been',
    'is', 'and', 'has',
    'have', 'with', 'that',
    'at', 'of', 'same'
];

foreach ($chains as $chain) {
    $this->addProperty($chain, function() {
        return $this;
    });
}

$this->addProperty('not', function() {
    return $this->flag('not', true);
});

$this->addMethod('equal', function($expected, $message = "") {
    $this->flag('message', $message);
    return new SameMatcher($expected);
});

$this->addMethod('throw', function($exceptionType, $exceptionMessage = '', $message = "") {
    $this->flag('message', $message);
    $matcher = new ExceptionMatcher($exceptionType);
    $matcher->setExpectedMessage($exceptionMessage);
    $matcher->setArguments($this->getArguments());
    return $matcher;
});