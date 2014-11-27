<?php
namespace Peridot\Leo\Matcher;

abstract class AbstractMatcher implements MatcherInterface
{
    /**
     * @var bool
     */
    protected $negated = false;

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
}
