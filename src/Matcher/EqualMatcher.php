<?php
namespace Peridot\Leo\Matcher;

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
}
