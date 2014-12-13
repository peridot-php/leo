<?php
namespace Peridot\Leo\Matcher\Template;

/**
 * Interface TemplateInterface specifices templates
 * for default and negated messages when formatting match
 * results.
 *
 * Template variables are wrapped in curly braces: {{expected}}, {{actual}}.
 *
 * Available variables are:
 *
 * {{expected}}
 * {{actual}}
 *
 * @code
 * $this->setDefaultTemplate("Expected {{expected}}, got {{actual}}");
 * @endcode
 *
 * @package Peridot\Leo\Matcher\Template
 */
interface TemplateInterface
{
    /**
     * Return the template variables assigned to the template.
     *
     * @return array
     */
    public function getTemplateVars();

    /**
     * Set the template vars assigned to the template.
     *
     * @param array $vars
     * @return mixed
     */
    public function setTemplateVars(array $vars);

    /**
     * Set the default template, that is the template for a failed match without
     * negation.
     *
     * @return string
     */
    public function getDefaultTemplate();

    /**
     * Set the default template that is used when negation is not specified.
     *
     * @param string $template
     * @return mixed
     */
    public function setDefaultTemplate($template);

    /**
     * Return the template used for a failed negated match.
     *
     * @return string
     */
    public function getNegatedTemplate();

    /**
     * Set the template used for a failed negated match.
     *
     * @param string $template
     * @return mixed
     */
    public function setNegatedTemplate($template);
}
