<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * MatcherInterface defines how an expected value is matched
 * against certain criteria. A matcher is also responsible for returning the TemplateInterface
 * used for formatting match results.
 *
 * @package Peridot\Leo\Matcher
 */
interface MatcherInterface
{
    /**
     * Returns whether or not the matcher is negated. A negated matcher negates
     * the results of a match.
     *
     * @return bool
     */
    public function isNegated();

    /**
     * Inverts a matcher. If a matcher is not negated, it will become negated. If a matcher
     * is negated, it will no longer be negated.
     *
     * @return $this
     */
    public function invert();

    /**
     * Perform a match against an actual value.
     *
     * @param mixed $actual
     * @return Match
     */
    public function match($actual);

    /**
     * Return the TemplateInterface being used by the matcher.
     *
     * @return TemplateInterface
     */
    public function getTemplate();

    /**
     * Set the Assertion bound to the matcher. Useful for checking
     * flags from within a matcher.
     *
     * @param Assertion $assertion
     * @return mixed
     */
    public function setAssertion(Assertion $assertion);

    /**
     * Set the TemplateInterface to use for formatting match results.
     *
     * @param TemplateInterface $template
     * @return $this
     */
    public function setTemplate(TemplateInterface $template);

    /**
     * Return a default TemplateInterface if none was set.
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate();
}
