<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Behavior\Bdd\FalseBehavior;
use Peridot\Leo\Behavior\Bdd\TrueBehavior;
use Peridot\Leo\Behavior\Bdd\InclusionBehavior;
use Peridot\Leo\Behavior\Bdd\OkBehavior;
use Peridot\Leo\Behavior\Bdd\TypeBehavior;
use Peridot\Leo\Flag\NotFlag;
use Peridot\Leo\Matcher\FalseMatcher;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Leo\Matcher\OkMatcher;
use Peridot\Leo\Matcher\TrueMatcher;
use Peridot\Leo\Matcher\TypeMatcher;

/**
 * The BDD interface contains a chainable interface that enhances
 * the readability of expectations.
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
 * @property Bdd $a
 * @property Bdd $an
 *
 * @method void an() an(string $type, string $message = "") validates the type of a subject
 * @method void a() a(string $type, string $message = "") validates the type of a subject
 * @method void include() include(mixed $needle, string $message = "") validates that a subject contains the needle
 * @method void contain() contain(mixed $needle, string $message = "") validates that a subject contains the needle
 * @method void ok() ok() validates that a subject is truthy
 * @method void true() true() validates that a subject is true
 * @method void false() false() validates that a subject is false
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
        $this->setBehavior(new TypeBehavior(new TypeMatcher(), $this));
        $this->setBehavior(new InclusionBehavior(new InclusionMatcher(), $this));
        $this->setBehavior(new OkBehavior(new OkMatcher(), $this));
        $this->setBehavior(new TrueBehavior(new TrueMatcher(), $this));
        $this->setBehavior(new FalseBehavior(new FalseMatcher(), $this));
    }

    /**
     * Include is an alias for the contain behavior. A method named "include" cannot
     * be defined by traditional means, so it is setup here to delegate to the contain behavior.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($name == "include") {
            return call_user_func_array([$this, 'contain'], $arguments);
        }
        return parent::__call($name, $arguments);
    }
}
