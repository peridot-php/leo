<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class EmptyBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function emtee($subject, $message = "")
    {
        $this->validate($subject, null, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notEmpty($subject, $message = "")
    {
        $this->negate()->validate($subject, null, $message);
    }
}
