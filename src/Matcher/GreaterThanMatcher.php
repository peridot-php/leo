<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class GreaterThanMatcher extends CountableMatcher
{
    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        $default = 'Expected {{actual}} to be above {{expected}}';
        $negated = 'Expected {{actual}} to be at most {{expected}}';

        if (isset($this->countable)) {
            $count = count($this->countable);
            $default = "Expected {{actual}} to have a length above {{expected}} but got $count";
            $negated = "Expected {{actual}} to not have a length above {{expected}}";
        }

        return new ArrayTemplate([
            'default' => $default,
            'negated' => $negated
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @param $number
     * @return bool
     */
    protected function matchNumeric($number)
    {
        return $number > $this->expected;
    }
}
