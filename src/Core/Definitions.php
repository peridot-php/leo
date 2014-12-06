<?php
/**
 * Main definition for Assertion. Define methods and properties here.
 *
 * @var Peridot\Leo\Assertion $assertion
 */
use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EmptyMatcher;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Leo\Matcher\NullMatcher;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Matcher\TrueMatcher;
use Peridot\Leo\Matcher\TruthyMatcher;
use Peridot\Leo\Matcher\TypeMatcher;

return function (Assertion $assertion) {
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
        $assertion->addProperty($chain, function () {
            return $this;
        });
    }

    $assertion->addProperty('not', function () {
        return $this->flag('not', true);
    });

    $assertion->addMethod('with', function () {
        return $this->flag('arguments', func_get_args());
    });

    $assertion->addMethod('equal', function ($expected, $message = "") {
        $this->flag('message', $message);
        return new SameMatcher($expected);
    });

    $assertion->addMethod('throw', function ($exceptionType, $exceptionMessage = '', $message = "") {
        $this->flag('message', $message);
        $matcher = new ExceptionMatcher($exceptionType);
        $matcher->setExpectedMessage($exceptionMessage);
        $matcher->setArguments($this->flag('arguments') ?: []);
        return $matcher;
    });

    $type = function ($expected, $message = "") {
        $this->flag('message', $message);
        return new TypeMatcher($expected);
    };

    $assertion
        ->addMethod('a', $type)
        ->addMethod('an', $type);

    $include = function ($expected, $message) {
        $this->flag('message', $message);
        return new InclusionMatcher($expected);
    };

    $assertion
        ->addMethod('include', $include)
        ->addMethod('contain', $include);

    $truthy = function ($message = "") {
        $this->flag('message', $message);
        return new TruthyMatcher();
    };

    $assertion
        ->addMethod('ok', $truthy)
        ->addProperty('ok', $truthy);

    $true = function ($message = "") {
        $this->flag('message', $message);
        return new TrueMatcher();
    };

    $assertion
        ->addMethod('true', $true)
        ->addProperty('true', $true);

    $false = function ($message = "") {
        $this->flag('message', $message);
        $matcher = new TrueMatcher();
        return $matcher->invert();
    };

    $assertion
        ->addMethod('false', $false)
        ->addProperty('false', $false);

    $null = function ($message = "") {
        $this->flag('message', $message);
        return new NullMatcher();
    };

    $assertion
        ->addMethod('null', $null)
        ->addProperty('null', $null);

    $empty = function ($message = "") {
        $this->flag('message', $message);
        return new EmptyMatcher();
    };

    $assertion
        ->addMethod('empty', $empty)
        ->addProperty('empty', $empty);
};
