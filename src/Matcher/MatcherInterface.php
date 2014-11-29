<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * Interface MatcherInterface defines how an expected value is matched
 * against certain criteria.
 *
 * @package Peridot\Leo\Matcher
 */
interface MatcherInterface
{
    /**
     * @return bool
     */
    public function isNegated();

    /**
     * @return $this
     */
    public function invert();

    /**
     * @param $actual
     * @return Match
     */
    public function match($actual);

    /**
     * @return TemplateInterface
     */
    public function getTemplate();

    /**
     * @param TemplateInterface $template
     * @return $this
     */
    public function setTemplate(TemplateInterface $template);

    /**
     * Return a default template if none was set.
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate();
} 
