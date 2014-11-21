<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Behavior\MatcherBehavior;

class InclusionBehavior extends MatcherBehavior
{
    /**
     * Validate haystack does include needle.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function contain($haystack, $needle, $message = "")
    {
        $this->validate($haystack, $needle, $message);
    }

    /**
     * Validate haystack does not include needle.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function notInclude($haystack, $needle, $message = "")
    {
        $this->negate($haystack, $needle, $message);
    }
}
