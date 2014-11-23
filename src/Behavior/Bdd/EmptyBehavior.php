<?php
namespace Peridot\Leo\Behavior\Bdd;

class EmptyBehavior extends SelfMatcherBehavior
{
    /**
     * @param string $message
     */
    public function emtee($message = "")
    {
        $this->validate(null, $message);
    }
}
