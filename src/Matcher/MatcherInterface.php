<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * Interface MatcherInterface determines if two values
 * match against a criteria.
 *
 * @package Peridot\Leo\Matcher
 */
interface MatcherInterface
{
    /**
     * @param mixed $expected
     * @param mixed $actual
     * @return bool
     */
    public function match($expected, $actual);

    /**
     * Invert the matching criteria. If not negated, the matcher
     * will become negated. If negated the matcher will revert
     * to a normal state.
     *
     * @return MatcherInterface
     */
    public function invert();

    /**
     * Return if the matcher is negated.
     *
     * @return bool
     */
    public function isNegated();

    /**
     * @return TemplateInterface
     */
    public function getTemplate();
}
