<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * LessThanMatcher determines if an actual value is less than the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class LessThanMatcher extends CountableMatcher
{
    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be below {{expected}}',
            'negated' => 'Expected {{actual}} to be at least {{expected}}'
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @return ArrayTemplate
     */
    public function getDefaultCountableTemplate()
    {
        $count = $this->getCount();
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to have a length below {{expected}} but got $count",
            'negated' => "Expected {{actual}} to not have a length below {{expected}}"
        ]);
    }

    /**
     * Match that actual number is less than the expected value.
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number < $this->expected;
    }
}
