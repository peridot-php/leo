<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * RangeMatcher matches a number or the length of a countable
 * between a lower and upper bound - both of which are inclusive.
 *
 * @package Peridot\Leo\Matcher
 */
class RangeMatcher extends CountableMatcher
{
    /**
     * @var int
     */
    protected $lowerBound;

    /**
     * @var int
     */
    protected $upperBound;

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     */
    public function __construct($lower, $upper)
    {
        $this->setLowerBound($lower);
        $this->setUpperBound($upper);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultCountableTemplate()
    {
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to be within {$this->lowerBound}..{$this->upperBound}",
            'negated' => "Expected {{actual}} to not be within {$this->lowerBound}..{$this->upperBound}"
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to be within {$this->lowerBound}..{$this->upperBound}",
            'negated' => "Expected {{actual}} to not be within {$this->lowerBound}..{$this->upperBound}"
        ]);
    }

    /**
     * Set the lower bound of the range matcher.
     *
     * @param int $lowerBound
     * @return $this
     */
    public function setLowerBound($lowerBound)
    {
        if (!is_numeric($lowerBound)) {
            throw new \InvalidArgumentException("Lower bound must be a numeric value");
        }

        $this->lowerBound = $lowerBound;
        return $this;
    }

    /**
     * Set the upper bound of the range matcher.
     *
     * @param int $upperBound
     * @return $this
     */
    public function setUpperBound($upperBound)
    {
        if (!is_numeric($upperBound)) {
            throw new \InvalidArgumentException("Upper bound must be a numeric value");
        }

        $this->upperBound = $upperBound;
        return $this;
    }

    /**
     * Return the lower bound of the range matcher.
     *
     * @return int
     */
    public function getLowerBound()
    {
        return $this->lowerBound;
    }

    /**
     * Return the upper bound of the range matcher.
     *
     * @return int
     */
    public function getUpperBound()
    {
        return $this->upperBound;
    }

    /**
     * Determine if the number is between an upper and lower bound (inclusive).
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number <= $this->upperBound && $number >= $this->lowerBound;
    }
}
