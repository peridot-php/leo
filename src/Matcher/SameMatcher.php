<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class SameMatcher extends AbstractMatcher
{
    /**
     * @param mixed $actual
     * @return bool
     */
    public function doMatch($actual)
    {
        return $this->expected === $actual;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{expected}} to be identical to {{actual}}',
            'negated' => 'Expected {{expected}} to be identical to {{actual}}'
        ]);
    }
}
