<?php
namespace Peridot\Leo\Matcher\Template;

class ArrayTemplate implements TemplateInterface
{
    /**
     * @var string
     */
    protected $default;

    /**
     * @var string
     */
    protected $negated;

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * @param array $templates
     */
    public function __construct(array $templates)
    {
        $this->default = $templates['default'];
        $this->negated = $templates['negated'];
    }

    /**
     * @return string
     */
    public function getDefaultTemplate()
    {
        return $this->default;
    }

    /**
     * @param string $default
     */
    public function setDefaultTemplate($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return string
     */
    public function getNegatedTemplate()
    {
        return $this->negated;
    }

    /**
     * @param string $negated
     */
    public function setNegatedTemplate($negated)
    {
        $this->negated = $negated;
        return $this;
    }

    /**
     * @return array
     */
    public function getTemplateVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     * @return $this
     */
    public function setTemplateVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }
}
