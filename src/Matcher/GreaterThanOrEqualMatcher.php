<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * GreaterThanOrEqualMatcher matches that the actual value is greater than or equal
 * to the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class GreaterThanOrEqualMatcher extends CountableMatcher
{
    /**
     * Match that the actual number is greater than or equal
     * to the expected value.
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number >= $this->expected;
    }

    /**
     * Return a default template if none was set.
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be at least {{expected}}',
            'negated' => 'Expected {{actual}} to be below {{expected}}'
        ]);
    }

    /**
     * Return a default template for when a countable has been set.
     *
     * @return TemplateInterface
     */
    public function getDefaultCountableTemplate()
    {
        $count = $this->getCount();
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to have a length at least {{expected}} but got $count",
            'negated' => 'Expected {{actual}} to have a length below {{expected}}'
        ]);
    }
}
