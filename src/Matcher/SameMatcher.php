<?php
namespace Peridot\Leo\Matcher;

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
} 
