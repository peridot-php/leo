<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * PatternMatcher determines if an actual string value matches a regular expression.
 *
 * @package Peridot\Leo\Matcher
 */
class PatternMatcher extends AbstractMatcher
{
    /**
     * Match the actual value against a regular expression
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        if (!is_string($actual)) {
            throw new \InvalidArgumentException("PatternMatcher expects a string");
        }

        return (bool) preg_match($this->expected, $actual);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to match {{expected}}',
            'negated' => 'Expected {{actual}} not to match {{expected}}'
        ]);
    }
}
