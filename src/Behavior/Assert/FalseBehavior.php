<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class FalseBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function false($subject, $message = "")
    {
        $this->validate($subject, null, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notFalse($subject, $message = "")
    {
        $this->negate()->validate($subject, null, $message);
    }
} 
