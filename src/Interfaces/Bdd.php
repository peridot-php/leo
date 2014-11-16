<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Flag\NotFlag;
use Peridot\Leo\Matcher\TypeMatcher;
use Peridot\Leo\Scope;

/**
 * The Leo Scope contains the chainable interface
 * and is the main entry point for making assertions.
 *
 * @package Peridot\Leo
 *
 * @property Bdd $to
 * @property Bdd $be
 * @property Bdd $been
 * @property Bdd $is
 * @property Bdd $that
 * @property Bdd $and
 * @property Bdd $has
 * @property Bdd $have
 * @property Bdd $with
 * @property Bdd $at
 * @property Bdd $of
 * @property Bdd $same
 * @property Bdd $not
 * @property Bdd $negated
 */
class Bdd extends AbstractBaseInterface
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
     * Initialize BDD interface with chainable properties
     */
    public function __construct($subject)
    {
        parent::__construct($subject);

        foreach ($this->chainables as $property) {
            $this->$property = $this;
        }

        $this->setFlag(new NotFlag());
        $this->addMatcher(new TypeMatcher($subject));
    }
} 
