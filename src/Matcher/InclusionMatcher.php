<?php

namespace Peridot\Leo\Matcher;

use InvalidArgumentException;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;
use Traversable;

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
        if ($actual instanceof Traversable) {
            $isMatch = false;

            foreach ($actual as $value) {
                if ($value === $this->expected) {
                    $isMatch = true;

                    break;
                }
            }

            return $isMatch;
        }

        if (is_array($actual)) {
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
