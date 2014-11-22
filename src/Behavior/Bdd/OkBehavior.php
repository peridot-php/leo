<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;

class OkBehavior extends MatcherBehavior
{
    /**
     * @param string $message
     */
    public function ok($message = "")
    {
        return $this->validate(null, $message);
    }

    /**
     * @param $args
     * @return array
     */
    protected function getValidateArguments($args)
    {
        return [$this->interface->getSubject(), null, $args[1]];
    }
} 
