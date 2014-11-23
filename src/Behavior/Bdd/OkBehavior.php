<?php
namespace Peridot\Leo\Behavior\Bdd;

class OkBehavior extends SelfMatcherBehavior
{
    /**
     * @param string $message
     */
    public function ok($message = "")
    {
        $this->validate(null, $message);
    }
}
