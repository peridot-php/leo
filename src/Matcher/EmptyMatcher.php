<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * EmptyMatcher determines if an actual value is empty via the php empty() function.
 * @package Peridot\Leo\Matcher
 */
class EmptyMatcher extends AbstractMatcher
{
    public function __construct()
    {

    }

    /**
     * Determin if the actual value is empty.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return empty($actual);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be empty',
            'negated' => 'Expected {{actual}} not to be empty'
        ]);
    }
}
