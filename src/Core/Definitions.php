<?php
/**
 * Main definition for Assertion. Define methods and properties here.
 *
 * @var Peridot\Leo\Assertion $assertion
 */
use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Matcher\TypeMatcher;

return function(Assertion $assertion) {
    /**
     * Default language chains.
     */
    $chains = [
        'to', 'be', 'been',
        'is', 'and', 'has',
        'have', 'with', 'that',
        'at', 'of', 'same',
        'an', 'a'
    ];

    foreach ($chains as $chain) {
        $assertion->addProperty($chain, function() {
            return $this;
        });
    }

    $assertion->addProperty('not', function() {
        return $this->flag('not', true);
    });

    $assertion->addMethod('with', function() {
        return $this->flag('arguments', func_get_args());
    });

    $assertion->addMethod('equal', function($expected, $message = "") {
        $this->flag('message', $message);
        return new SameMatcher($expected);
    });

    $assertion->addMethod('throw', function($exceptionType, $exceptionMessage = '', $message = "") {
        $this->flag('message', $message);
        $matcher = new ExceptionMatcher($exceptionType);
        $matcher->setExpectedMessage($exceptionMessage);
        $matcher->setArguments($this->flag('arguments') ?: []);
        return $matcher;
    });

    $type = function($expected, $message = "") {
        $this->flag('message', $message);
        return new TypeMatcher($expected);
    };

    $assertion
        ->addMethod('a', $type)
        ->addMethod('an', $type);
};
