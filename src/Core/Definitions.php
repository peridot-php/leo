<?php
/**
 * Main definition for Assertion. Define core methods and properties here.
 */
use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\EmptyMatcher;
use Peridot\Leo\Matcher\EqualMatcher;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Leo\Matcher\InstanceofMatcher;
use Peridot\Leo\Matcher\KeysMatcher;
use Peridot\Leo\Matcher\LengthMatcher;
use Peridot\Leo\Matcher\NullMatcher;
use Peridot\Leo\Matcher\PatternMatcher;
use Peridot\Leo\Matcher\PredicateMatcher;
use Peridot\Leo\Matcher\PropertyMatcher;
use Peridot\Leo\Matcher\RangeMatcher;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Matcher\SubStringMatcher;
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
        }, true);
    }

    $assertion->addProperty('not', function () {
        return $this->flag('not', true);
    });

    $assertion->addMethod('with', function () {
        return $this->flag('arguments', func_get_args());
    });

    $assertion->addProperty('loosely', function () {
        return $this->flag('loosely', true);
    });

    $assertion->addMethod('equal', function ($expected, $message = "") {
        $this->flag('message', $message);
        if ($this->flag('loosely')) {
            return new EqualMatcher($expected);
        }
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

    $include = function ($expected, $message = "") {
        $this->flag('message', $message);
        return new InclusionMatcher($expected);
    };

    $assertion
        ->addMethod('include', $include)
        ->addMethod('contain', $include);

    $contain = function () {
        return $this->flag('contain', true);
    };

    $assertion
        ->addProperty('contain', $contain)
        ->addProperty('include', $contain);

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

    $assertion->addProperty('length', function () {
        return $this->flag('length', $this->getActual());
    });

    /**
     * Define a helper for creating countable matchers. A countable
     * matcher is a matcher that matches against a single numeric
     * value, or a value that can be reduced to a single numeric value
     * via the count() function.
     *
     * @param $className
     * @return callable
     */
    $countable = function ($className) {
        return function ($expected, $message = "") use ($className) {
            $this->flag('message', $message);
            $class = "Peridot\\Leo\\Matcher\\$className";
            $matcher = new $class($expected);
            if ($countable = $this->flag('length')) {
                $matcher->setCountable($countable);
            }
            return $matcher;
        };
    };

    $assertion->addMethod('above', $countable('GreaterThanMatcher'));
    $assertion->addMethod('least', $countable('GreaterThanOrEqualMatcher'));
    $assertion->addMethod('below', $countable('LessThanMatcher'));
    $assertion->addMethod('most', $countable('LessThanOrEqualMatcher'));

    $assertion->addMethod('within', function ($lower, $upper, $message = "") {
        $this->flag('message', $message);
        $matcher = new RangeMatcher($lower, $upper);
        if ($countable = $this->flag('length')) {
            $matcher->setCountable($countable);
        }
        return $matcher;
    });

    $assertion->addMethod('instanceof', function ($expected, $message = "") {
        $this->flag('message', $message);
        return new InstanceofMatcher($expected);
    });

    $assertion->addProperty('deep', function () {
        return $this->flag('deep', true);
    });

    $assertion->addMethod('property', function ($name, $value = "", $message = "") {
        $this->flag('message', $message);
        $matcher = new PropertyMatcher($name, $value);
        $matcher->setAssertion($this);
        return $matcher->setIsDeep($this->flag('deep'));
    });

    $assertion->addMethod('length', function ($expected, $message = "") {
        $this->flag('message', $message);
        return new LengthMatcher($expected);
    });

    $assertion->addMethod('match', function ($pattern, $message = "") {
        $this->flag('message', $message);
        return new PatternMatcher($pattern);
    });

    $assertion->addMethod('string', function ($expected, $message = "") {
        $this->flag('message', $message);
        return new SubStringMatcher($expected);
    });

    $assertion->addMethod('keys', function (array $keys, $message = "") {
        $this->flag('message', $message);
        return new KeysMatcher($keys);
    });

    $assertion->addMethod('satisfy', function (callable $predicate, $message = "") {
        $this->flag('message', $message);
        return new PredicateMatcher($predicate);
    });
};
