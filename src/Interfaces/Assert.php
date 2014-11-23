<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Behavior\Assert\FalseBehavior;
use Peridot\Leo\Behavior\Assert\InclusionBehavior;
use Peridot\Leo\Behavior\Assert\OkBehavior;
use Peridot\Leo\Behavior\Assert\TrueBehavior;
use Peridot\Leo\Behavior\Assert\TypeBehavior;
use Peridot\Leo\Matcher\FalseMatcher;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Leo\Matcher\OkMatcher;
use Peridot\Leo\Matcher\TrueMatcher;
use Peridot\Leo\Matcher\TypeMatcher;

/**
 * Assert is a traditional assert style interface.
 *
 * @method void typeOf() typeOf(mixed $value, string $type, string $message = "") validates the type of the passed in value
 * @method void notTypeOf() notTypeOf(mixed $value, string $type, string $message = "") validates that the type of a subject is not the given type
 * @method void include() include(mixed $haystack, mixed $needle, string $message = "") validates that a haystack contains the needle
 * @method void contain() contain(mixed $haystack, mixed $needle, string $message = "") validates that a haystack contains the needle
 * @method void notInclude() notInclude(mixed $haystack, mixed $needle, string $message = "") validates that a haystack does not contain a needle
 * @method void ok() ok(mixed $subject, string $message = "") validates a value is truthy
 * @method void notOk() notOk(mixed $subject, string $message ="") validates a value is not truthy
 * @method void true() true(mixed $subject, string $message = "") validates that a value is true
 * @method void notTrue notTrue(mixed $subject, string $message = "") validates that a value is not true
 * @method void false() false(mixed $subject, string $message = "") validates that a value is false
 * @method void notFalse() notFalse(mixed $subject, string $message = "") validates that a value is not false
 *
 * @package Peridot\Leo\Interfaces
 */
class Assert extends AbstractBaseInterface
{
    public function __construct($subject = null)
    {
        parent::__construct($subject);

        $this->setBehavior(new TypeBehavior(new TypeMatcher()));
        $this->setBehavior(new InclusionBehavior(new InclusionMatcher()));
        $this->setBehavior(new OkBehavior(new OkMatcher()));
        $this->setBehavior(new TrueBehavior(new TrueMatcher()));
        $this->setBehavior(new FalseBehavior(new FalseMatcher()));
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
