<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class TrueMatcher extends AbstractMatcher
{
    public function __construct()
    {
        
    }

    /**
     * {@inheritdoc}
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
