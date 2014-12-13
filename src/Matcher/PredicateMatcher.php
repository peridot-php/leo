<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class PredicateMatcher extends AbstractMatcher
{
    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to satisfy {{expected}}',
            'negated' => 'Expected {{actual}} to not satisfy {{expected}}'
        ]);
    }

    /**
     * Match actual value against expected predicate
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return (bool) call_user_func_array($this->expected, [$actual]);
    }
}
