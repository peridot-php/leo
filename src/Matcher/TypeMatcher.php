<?php
namespace Peridot\Leo\Matcher;

class TypeMatcher extends AbstractBaseMatcher
{
    /**
     * Assert that the passed in type is the same
     * as the assertion subject.
     *
     * @param $type
     * @throws \Exception
     */
    public function a($type)
    {
        $this->validate($type, gettype($this->getSubject()));
    }

    /**
     * An alias for the 'a' validation.
     *
     * @param $type
     */
    public function an($type)
    {
        $this->a($type);
    }
} 
