<?php
use Peridot\Leo\Assertion;
use Peridot\Leo\Leo;

/**
 * Returns Leo's Assertion object and sets
 * the actual value on it. The returned Assertion can then
 * be used for extension and chainable assertions.
 *
 * @param mixed $actual
 * @return Assertion
 */
function expect($actual)
{
    $instance = Leo::instance();
    $assertion = $instance->getAssertion();
    return $assertion->setActual($actual);
}
