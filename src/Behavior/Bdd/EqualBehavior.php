<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;

class EqualBehavior extends MatcherBehavior
{
    /**
     * @param string $message
     */
    public function equal($expected, $message = "")
    {
        $this->validate($expected, $message);
    }
} 
