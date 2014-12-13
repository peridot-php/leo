<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * TrueMatcher determines if an actual value is strictly equal to true.
 *
 * @package Peridot\Leo\Matcher
 */
class TrueMatcher extends AbstractMatcher
{
    public function __construct()
    {
        
    }

    /**
     * Match if the actuall value is strictly equal to true.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return $actual === true;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be true',
            'negated' => 'Expected {{actual}} to be false'
        ]);
    }
}
