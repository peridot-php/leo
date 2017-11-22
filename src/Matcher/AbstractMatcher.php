<?php

namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * AbstractMatcher serves as the base for most Matchers.
 *
 * @package Peridot\Leo\Matcher
 */
abstract class AbstractMatcher implements MatcherInterface
{
    use MatcherTrait;

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
     * @param  mixed $actual
     * @return Match
     */
    public function match($actual = '')
    {
        $isMatch = $this->doMatch($actual);
        $isNegated = $this->isNegated();
        $fulfillsExpectation = ($isMatch xor $isNegated);

        $match = new Match($fulfillsExpectation, $this->expected, $actual, $isNegated);
        if ((!$fulfillsExpectation) && method_exists($this, "differ")) {
            $match->differ = [$this, "differ"];
        }
        return $match;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if (!isset($this->template)) {
            return $this->getDefaultTemplate();
        }

        return $this->template;
    }

    /**
     * The actual matching algorithm for the matcher. This is called by ->match()
     * to create a Match result.
     *
     * @param  mixed $actual
     * @return bool
     */
    abstract protected function doMatch($actual);

    /**
     * @var mixed
     */
    protected $expected;
}
