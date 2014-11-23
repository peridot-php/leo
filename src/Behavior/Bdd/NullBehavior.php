<?php
namespace Peridot\Leo\Behavior\Bdd;

class NullBehavior extends SelfMatcherBehavior
{
    /**
     * @param string $message
     */
    public function null($message = "")
    {
        $this->validate(null, $message);
    }
}
