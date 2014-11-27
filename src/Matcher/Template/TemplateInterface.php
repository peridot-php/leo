<?php
namespace Peridot\Leo\Matcher\Template;

/**
 * Interface TemplateInterface defines how a matcher
 * should render feedback messages.
 *
 * @package Peridot\Leo\Matcher\Template
 */
interface TemplateInterface
{
    /**
     * Return the default template for a matcher.
     * i.e Expected {{expected}}, got {{actual}}
     *
     * @return string
     */
    public function getDefaultTemplate();

    /**
     * Return a template for a negated matcher.
     * i.e Expected {{expected}} not to to be {{actual}}
     *
     * @return string
     */
    public function getNegatedTemplate();
} 
