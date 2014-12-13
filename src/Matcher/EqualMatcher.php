<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * EqualMatcher determines if the expected value and the actual value are loosely equal. Peroforms
 * an == comparison.
 *
 * @package Peridot\Leo\Matcher
 */
class EqualMatcher extends AbstractMatcher
{
    /**
     * Determine if value is loosely equal to the expected
     * value.
     *
     * @param $actual
     * @return bool
     */
    public function doMatch($actual)
    {
        return $this->expected == $actual;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{expected}}, got {{actual}}',
            'negated' => 'Expected {{expected}} not to equal {{actual}}'
        ]);
    }
}
