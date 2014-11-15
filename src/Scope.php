<?php
namespace Peridot\Leo;

use Peridot\Scope\Scope as PeridotScope;

class Scope extends PeridotScope
{
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
     * Initialize LeoScope with chainable properties
     */
    public function __construct()
    {
        foreach ($this->chainables as $property) {
            $this->$property = $this;
        }
    }
} 
