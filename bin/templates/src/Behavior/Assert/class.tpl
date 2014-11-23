<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class {{name}}Behavior extends MatcherBehavior
{
    /**
     * @param $subject
     * @param string $message
     */
    public function {{behavior}}($subject, $actual, $message = "")
    {
        $this->validate($subject, $actual, $message);
    }

    /**
     * @param $subject
     * @param string $message
     */
    public function not{{name}}($subject, $actual, $message = "")
    {
        $this->negate()->validate($subject, $actual, $message);
    }
} 
