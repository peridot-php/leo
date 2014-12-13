<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * LessThanOrEqualMatcher determines if an actual value is less than or equal to the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class LessThanOrEqualMatcher extends CountableMatcher
{
    /**
     * Match that the actual number is less than or equal
     * to the expected value.
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number <= $this->expected;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be at most {{expected}}',
            'negated' => 'Expected {{actual}} to be above {{expected}}'
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultCountableTemplate()
    {
        $count = $this->getCount();
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to have a length at most {{expected}} but got $count",
            'negated' => 'Expected {{actual}} to have a length above {{expected}}'
        ]);
    }
}
