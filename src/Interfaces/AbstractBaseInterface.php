<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Flag\FlagInterface;
use Peridot\Scope\Scope;

class AbstractBaseInterface extends Scope
{
    /**
     * @var array
     */
    protected $flags = [];

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
} 
