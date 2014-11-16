<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Flag\FlagInterface;
use Peridot\Leo\Matcher\TypeMatcher;
use Peridot\Scope\Scope;

class AbstractBaseInterface extends Scope
{
    /**
     * @var array
     */
    protected $flags = [];

    /**
     * @var mixed
     */
    protected $subject;

    /**
     * @var array
     */
    protected $matchers = [];

    /**
     * @param mixed $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return bool
     */
    public function isNegated()
    {
        if (!isset($this->negated)) {
            return false;
        }
        return $this->negated;
    }

    /**
     * @param FlagInterface $flag
     * @return $this
     */
    public function setFlag(FlagInterface $flag)
    {
        $this->flags[$flag->getId()] = $flag;
        return $this;
    }

    /**
     * @param string $property
     * @return mixed|void
     */
    public function &__get($property)
    {
        if (isset($this->flags[$property])) {
            $result = call_user_func($this->flags[$property], $this);
            if (! is_object($result)) {
                return $this;
            }
            return $result;
        }
        return parent::__get($property);
    }

    /**
     * Return the subject being asserted against
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the subject to assert against
     *
     * @param mixed $actual
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param TypeMatcher $matcher
     */
    public function addMatcher(TypeMatcher $matcher)
    {
        $this->peridotAddChildScope($matcher);
    }
} 
