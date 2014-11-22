<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class OkBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function ok($subject, $message = "")
    {
        $this->validate($subject, null, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notOk($subject, $message = "")
    {
        $this->negate()->validate($subject, null, $message);
    }
} 
