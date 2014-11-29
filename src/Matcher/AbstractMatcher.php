<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

abstract class AbstractMatcher
{
    /**
     * @var mixed
     */
    protected $expected;

    /**
     * @var bool
     */
    protected $negated = false;

    /**
     * @var TemplateInterface
     */
    protected $template;

    /**
     * @param mixed $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * @return bool
     */
    public function isNegated()
    {
        return $this->negated;
    }

    /**
     * @return $this
     */
    public function invert()
    {
        $this->negated = !$this->negated;
        return $this;
    }

    /**
     * @param $actual
     * @return Match
     */
    public function match($actual)
    {
        $isMatch = $this->doMatch($actual);
        if ($this->isNegated()) {
            $isMatch = !$isMatch;
        }
        return new Match($isMatch, $this->expected, $actual, $this->isNegated());
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if (! isset($this->template)) {
            return $this->getDefaultTemplate();
        }
        return $this->template;
    }

    /**
     * @param TemplateInterface $template
     * @return $this
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Return a default template if none was set.
     *
     * @return TemplateInterface
     */
    abstract public function getDefaultTemplate();

    /**
     * The actual matching algorithm for the matcher.
     *
     * @param $actual
     * @return mixed
     */
    abstract protected function doMatch($actual);
} 
