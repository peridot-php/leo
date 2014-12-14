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
    /**
     * Match if the actual value is identical to the expected value using an ===
     * comparison.
     *
     * @param mixed $actual
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
            'default' => 'Expected {{expected}} to be identical to {{actual}}',
            'negated' => 'Expected {{expected}} not to be identical to {{actual}}'
        ]);
    }
}
