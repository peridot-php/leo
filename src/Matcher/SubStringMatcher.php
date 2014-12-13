<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * SubStringMatcher determines if an actual string contains the expected sub string.
 *
 * @package Peridot\Leo\Matcher
 */
class SubStringMatcher extends AbstractMatcher
{
    /**
     * Match that actual value has the expected sub string.
     *
     * @param string $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        if (! is_string($actual)) {
            throw new \InvalidArgumentException("SubStringMatcher requires string value");
        }

        return strpos($actual, $this->expected) !== false;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to contain {{expected}}',
            'negated' => 'Expected {{actual}} to not contain {{expected}}'
        ]);
    }
}
