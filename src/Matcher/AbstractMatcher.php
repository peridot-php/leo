<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * Class AbstractMatcher
 * @package Peridot\Leo\Matcher
 */
abstract class AbstractMatcher implements MatcherInterface
{
    /**
     * @var bool
     */
    protected $negated = false;

    /**
     * @var TemplateInterface
     */
    protected $template;

    /**
     * @param TemplateInterface $template
     */
    public function __construct(TemplateInterface $template)
    {
        $this->template = $template;
    }

    /**
     * {@inheritdoc}
     *
     * @return MatcherInterface
     */
    public function invert()
    {
        $this->negated = !$this->negated;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function isNegated()
    {
        return $this->negated;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
