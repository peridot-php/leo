<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

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
     * @return ArrayTemplate
     */
    public function getDefaultCountableTemplate()
    {
        $count = count($this->countable);
        return new ArrayTemplate([
            'default' => "Expected {{actual}} to have a length below {{expected}} but got $count",
            'negated' => "Expected {{actual}} to not have a length below {{expected}}"
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
        return $number < $this->expected;
    }
}
