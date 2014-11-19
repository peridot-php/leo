<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Behavior\Assert\TypeBehavior;

/**
 * Assert is a traditional assert style interface.
 *
 * @method void typeOf() typeOf(mixed $value, string $type, string $message = "") validates the type of the passed in value
 * @method void notTypeOf() notTypeOf(mixed $value, string $type, string $message = "") validates that the type of a subject is not the given type
 *
 * @package Peridot\Leo\Interfaces
 */
class Assert extends AbstractBaseInterface
{
    public function __construct($subject = null)
    {
        parent::__construct($subject);

        $this->setBehavior(new TypeBehavior());
    }
}
