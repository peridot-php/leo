<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * NullMatcher determines if an actual value is null.
 *
 * @package Peridot\Leo\Matcher
 */
class NullMatcher extends AbstractMatcher
{
    public function __construct()
    {

    }

    /**
     * Match if the actual value is null.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return is_null($actual);
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be null',
            'negated' => 'Expected {{actual}} not to be null'
        ]);
    }
}
