<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * InstanceofMatcher determines if the actual value is an instance of the expected
 * class string.
 *
 * @package Peridot\Leo\Matcher
 */
class InstanceofMatcher extends AbstractMatcher
{
    /**
     * See if actual value is an instance of the expected class.
     *
     * @param mixed $actual
     * @return bool
     */
    protected function doMatch($actual)
    {
        return $actual instanceof $this->expected;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be instance of {{expected}}',
            'negated' => 'Expected {{actual}} to not be an instance of {{expected}}'
        ]);
    }
}
