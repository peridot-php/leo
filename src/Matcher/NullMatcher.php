<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class NullMatcher extends AbstractMatcher
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
