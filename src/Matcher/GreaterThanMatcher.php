<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * GreaterThanMatcher determines if the actual value is greater than the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class GreaterThanMatcher extends CountableMatcher
{
    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be above {{expected}}',
            'negated' => 'Expected {{actual}} to be at most {{expected}}'
        ]);
    }

    /**
     * @return ArrayTemplate
     */
    public function getDefaultCountableTemplate()
    {
        $count = $this->getCount();
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to have a length above {{expected}} but got $count",
            'negated' => "Expected {{actual}} to not have a length above {{expected}}"
        ]);
    }

    /**
     * Match that actual number is greater than the expected value.
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number > $this->expected;
    }
}
