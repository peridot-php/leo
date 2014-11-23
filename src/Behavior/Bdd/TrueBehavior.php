<?php
namespace Peridot\Leo\Behavior\Bdd;

class TrueBehavior extends SelfMatcherBehavior
{
    /**
     * @param string $message
     */
    public function true($message = "")
    {
        $this->validate(null, $message);
    }
}
