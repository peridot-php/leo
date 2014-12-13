<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * PredicateMatcher executes a function with the actual value. The PredicateMatcher returns
 * the result of that function call as a Match result.
 *
 * @package Peridot\Leo\Matcher
 */
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
     * Match actual value against the expected predicate.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        return (bool) call_user_func_array($this->expected, [$actual]);
    }
}
