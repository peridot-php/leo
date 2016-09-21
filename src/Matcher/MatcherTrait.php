<?php

namespace Peridot\Leo\Matcher;

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * MatcherTrait provides some common implementation details for matchers.
 *
 * @package Peridot\Leo\Matcher
 */
trait MatcherTrait
{
    /**
     * Returns whether or not the matcher is negated. A negated matcher negates
     * the results of a match.
     *
     * @return bool
     */
    public function isNegated()
    {
        return $this->negated;
    }

    /**
     * Inverts a matcher. If a matcher is not negated, it will become negated. If a matcher
     * is negated, it will no longer be negated.
     *
     * @return $this
     */
    public function invert()
    {
        $this->negated = !$this->negated;

        return $this;
    }

    /**
     * Set the TemplateInterface to use for formatting match results.
     *
     * @param  TemplateInterface $template
     * @return $this
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Set the Assertion bound to the matcher. Useful for checking
     * flags from within a matcher.
     *
     * @param  Assertion $assertion
     * @return mixed
     */
    public function setAssertion(Assertion $assertion)
    {
        $this->assertion = $assertion;

        return $this;
    }

    /**
     * @var bool
     */
    protected $negated = false;

    /**
     * @var TemplateInterface
     */
    protected $template;

    /**
     * @var Assertion
     */
    protected $assertion;
}
