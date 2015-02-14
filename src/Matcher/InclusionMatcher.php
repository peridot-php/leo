<?php

namespace Peridot\Leo\Matcher;

use ArrayAccess;
use InvalidArgumentException;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * InclusionMatcher determines if an array or string includes the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class InclusionMatcher extends AbstractMatcher
{
    /**
     * Matches if an array or string contains the expected value.
     *
     * @param $actual
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function doMatch($actual)
    {
        //we will support ArrayAccess for now, even though array_search throws a warning about it
        if (is_array($actual) or $actual instanceof ArrayAccess) {
            return array_search($this->expected, $actual, true) !== false;
        }

        if (is_string($actual)) {
            return strpos($actual, $this->expected) !== false;
        }

        throw new InvalidArgumentException("Inclusion matcher requires a string or array");
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to include {{expected}}',
            'negated' => 'Expected {{actual}} to not include {{expected}}'
        ]);
    }
}
