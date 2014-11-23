<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class NullBehavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function null($subject, $message = "")
    {
        $this->validate($subject, null, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function notNull($subject, $message = "")
    {
        $this->negate()->validate($subject, null, $message);
    }
}
