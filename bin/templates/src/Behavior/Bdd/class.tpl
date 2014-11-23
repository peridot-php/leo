<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;

class {{name}}Behavior extends MatcherBehavior
{
    /**
     * @param string $message
     */
    public function {{behavior}}($expected, $message = "")
    {
        $this->validate($expected, $message);
    }
} 
