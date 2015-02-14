<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * AbstractMatcher serves as the base for all Matchers.
 *
 * @package Peridot\Leo\Matcher
 */
abstract class AbstractMatcher implements MatcherInterface
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
     * @var Assertion
     */
    protected $assertion;

    /**
     * @param mixed $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
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
     * {@inheritdoc}
     *
     * @return $this
     */
    public function invert()
    {
        $this->negated = !$this->negated;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $actual
     * @return Match
     */
    public function match($actual = "")
    {
        $isMatch = $this->doMatch($actual);
        if ($this->isNegated()) {
            $isMatch = !$isMatch;
        }
        return new Match($isMatch, $this->expected, $actual, $this->isNegated());
    }

    /**
     * {@inheritdoc}
     *
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
     * {@inheritdoc}
     *
     * @param TemplateInterface $template
     * @return $this
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param Assertion $assertion
     * @return $this
     */
    public function setAssertion(Assertion $assertion)
    {
        $this->assertion = $assertion;
        return $this;
    }

    /**
     * The actual matching algorithm for the matcher. This is called by ->match()
     * to create a Match result.
     *
     * @param mixed $actual
     * @return bool
     */
    abstract protected function doMatch($actual);
}
