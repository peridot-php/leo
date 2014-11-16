<?php
namespace Peridot\Leo;

use Peridot\Leo\Flag\FlagInterface;
use Peridot\Leo\Flag\NotFlag;
use Peridot\Scope\Scope as PeridotScope;

/**
 * The Leo Scope contains the chainable interface
 * and is the main entry point for making assertions.
 *
 * @package Peridot\Leo
 *
 * @property Scope $to
 * @property Scope $be
 * @property Scope $been
 * @property Scope $is
 * @property Scope $that
 * @property Scope $and
 * @property Scope $has
 * @property Scope $have
 * @property Scope $with
 * @property Scope $at
 * @property Scope $of
 * @property Scope $same
 * @property Scope $not
 * @property bool $negated
 */
class Scope extends PeridotScope
{
    /**
     * Specifies the chainable interface for assertions
     *
     * @var array
     */
    protected $chainables = [
        'to',
        'be',
        'been',
        'is',
        'that',
        'and',
        'has',
        'have',
        'with',
        'at',
        'of',
        'same'
    ];

    /**
     * @var array
     */
    protected $flags;

    /**
     * Initialize LeoScope with chainable properties
     */
    public function __construct()
    {
        $this->flags = [];
        foreach ($this->chainables as $property) {
            $this->$property = $this;
        }
        $this->setFlag(new NotFlag());
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
     * @param $property
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
