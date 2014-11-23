<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;

abstract class SelfMatcherBehavior extends MatcherBehavior
{
    /**
     * @param $args
     * @return array
     */
    protected function getValidateArguments($args)
    {
        $val = 1;
        return [$this->interface->getSubject(), null, $args[1]];
    }
} 
