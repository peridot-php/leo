<?php
namespace Peridot\Leo\Behavior\Bdd;

class FalseBehavior extends SelfMatcherBehavior
{
    /**
     * @param string $message
     */
    public function false($message = "")
    {
        $this->validate(null, $message);
    }
} 
