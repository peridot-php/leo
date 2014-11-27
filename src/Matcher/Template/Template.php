<?php
namespace Peridot\Leo\Matcher\Template;

/**
 * Class Template
 * @package Peridot\Leo\Matcher\Template
 */
class Template implements TemplateInterface
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
     * Construct the template with an array:
     *
     * @code
     * $data = [
     *     'default' => 'Expected {{expected}}, got {{actual}}',
     *     'negated' => 'Expected {{expected}} not to be {{actual}}
     * ];
     * @end code
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->default = $data['default'];
        $this->negated = $data['negated'];
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
     * @return string
     */
    public function getNegatedTemplate()
    {
        return $this->negated;
    }
}
