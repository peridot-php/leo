<?php
namespace Peridot\Leo;

use Peridot\Scope\Scope as PeridotScope;

/**
 * The Leo Scope contains the chainable interface
 * and is the main entry point for making assertions.
 *
 * @package Peridot\Leo
 *
 * @property Scope to
 * @property Scope be
 * @property Scope been
 * @property Scope is
 * @property Scope that
 * @property Scope and
 * @property Scope has
 * @property Scope have
 * @property Scope with
 * @property Scope at
 * @property Scope of
 * @property Scope same
 * @property Scope not
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
     * @var bool
     */
    protected $negated = false;

    /**
     * Initialize LeoScope with chainable properties
     */
    public function __construct()
    {
        foreach ($this->chainables as $property) {
            $this->$property = $this;
        }
    }

    /**
     * @return bool
     */
    public function isNegated()
    {
        return $this->negated;
    }

    /**
     * @param $property
     * @return mixed|void
     */
    public function &__get($property)
    {
        if ($property == 'not') {
            $this->negated = true;
            return $this;
        }
        return parent::__get($property);
    }
} 
