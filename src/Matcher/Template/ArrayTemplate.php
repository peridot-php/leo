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
}
