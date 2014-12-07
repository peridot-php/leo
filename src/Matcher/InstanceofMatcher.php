<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class InstanceofMatcher extends AbstractMatcher
{
    /**
     * See if actual value is an instance of the expected class.
     *
     * @param $actual
     * @return bool
     */
    protected function doMatch($actual)
    {
        return $actual instanceof $this->expected;
    }

    /**
     * Return a default template if none was set.
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{actual}} to be instance of {{expected}}',
            'negated' => 'Expected {{actual}} to not be an instance of {{expected}}'
        ]);
    }
}
