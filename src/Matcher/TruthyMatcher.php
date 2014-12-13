<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * TruthyMatcher determines if an actual value is truthy.
 *
 * @package Peridot\Leo\Matcher
 */
class TruthyMatcher extends AbstractMatcher
{
    public function __construct()
    {
        
    }

    /**
     * Match if the actual value is truthy - that is - it is true when cast to a (bool).
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return (bool) $actual;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be truthy',
            'negated' => 'Expected {{actual}} to be falsy'
        ]);
    }
}
