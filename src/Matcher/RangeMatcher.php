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


    public function __construct()
    {

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
            'negeted' => "Expected {{actual}} to not be within {$this->lowerBound}..{$this->upperBound}"
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
     * @return int
     */
    public function getLowerBound()
    {
        return $this->lowerBound;
    }

    /**
     * @return int
     */
    public function getUpperBound()
    {
        return $this->upperBound;
    }

    /**
     * Determine if the number is between an upper and lower bound.
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        if (!isset($this->lowerBound, $this->upperBound)) {
            throw new \InvalidArgumentException("RangeMatcher requires an upper and lower bound");
        }

        return $number <= $this->upperBound && $number >= $this->lowerBound;
    }
}
