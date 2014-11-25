<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class EqualBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function equal($subject, $actual, $message = "")
    {
        $this->validate($subject, $actual, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notEqual($subject, $actual, $message = "")
    {
        $this->negate()->validate($subject, $actual, $message);
    }
}
