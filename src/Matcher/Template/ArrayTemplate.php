<?php
namespace Peridot\Leo\Matcher\Template;

/**
 * ArrayTemplate uses an array to specify default and negated templates. An ArrayTemplate is constructed
 * with array keys.
 *
 * @code
 * $template = new ArrayTemplate([
 *     'default' => "Expected {{actual}} to be {{expected}}",
 *     'negated' => "Expected {{actual}} not to be {{expected}}
 * ]);
 * @endcode
 *
 * @package Peridot\Leo\Matcher\Template
 */
class ArrayTemplate implements TemplateInterface
{
    /**
     * @var string
     */
    protected $default = '';

    /**
     * @var string
     */
    protected $negated = '';

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * @param array $templates
     */
    public function __construct(array $templates)
    {
        if (array_key_exists('default', $templates)) {
            $this->default = $templates['default'];
        }

        if (array_key_exists('negated', $templates)) {
            $this->negated = $templates['negated'];
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getDefaultTemplate()
    {
        return $this->default;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $default
     */
    public function setDefaultTemplate($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getNegatedTemplate()
    {
        return $this->negated;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $negated
     */
    public function setNegatedTemplate($negated)
    {
        $this->negated = $negated;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getTemplateVars()
    {
        return $this->vars;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $vars
     * @return $this
     */
    public function setTemplateVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }
}
