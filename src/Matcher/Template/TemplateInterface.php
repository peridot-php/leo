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
     * @return array
     */
    public function getTemplateVars();

    /**
     * @param array $vars
     * @return mixed
     */
    public function setTemplateVars(array $vars);

    /**
     * @return string
     */
    public function getDefaultTemplate();

    /**
     * @param string $template
     * @return mixed
     */
    public function setDefaultTemplate($template);

    /**
     * @return string
     */
    public function getNegatedTemplate();

    /**
     * @param string $template
     * @return mixed
     */
    public function setNegatedTemplate($template);
}
