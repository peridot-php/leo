<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

class EqualMatcher extends AbstractMatcher
{
    /**
     * Determine if value is loosely equal to the expected
     * value.
     *
     * @param $actual
     * @return bool
     */
    public function doMatch($actual)
    {
        return $this->expected == $actual;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        // TODO: Implement getDefaultTemplate() method.
    }
}
