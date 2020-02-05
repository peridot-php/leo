<?php

namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * SameMatcher determines if an actual value is identical to the expected value.
 * @package Peridot\Leo\Matcher
 */
class SameMatcher extends AbstractMatcher
{
    public function differ($actual, $expected) {
        return "THE CALCULATED DIFF";
    }

    /**
     * Match if the actual value is identical to the expected value using an ===
     * comparison.
     *
     * @param  mixed $actual
     * @return bool
     */
    public function doMatch($actual)
    {
        return $this->expected === $actual;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be identical to {{expected}}. Difference: {{diff}}',
            'negated' => 'Expected {{actual}} not to be identical to {{expected}}',
        ]);
    }
}
