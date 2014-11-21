<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class TypeBehavior extends MatcherBehavior
{
    /**
     * Validate that the subject is of the expected type.
     *
     * @param mixed $subject
     * @param string $expectedType
     * @param string $message
     */
    public function typeOf($subject, $expectedType, $message = "")
    {
        $this->validate($subject, $expectedType, $message);
    }

    /**
     * Validate that the subject is not the expected type.
     *
     * @param $subject
     * @param $expectedType
     * @param string $message
     */
    public function notTypeOf($subject, $expectedType, $message = "")
    {
        $this->negate()->typeOf($subject, $expectedType, $message);
    }
}
