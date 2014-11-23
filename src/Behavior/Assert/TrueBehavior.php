<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class TrueBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function true($subject, $message = "")
    {
        $this->validate($subject, null, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notTrue($subject, $message = "")
    {
        $this->negate()->validate($subject, null, $message);
    }
}
