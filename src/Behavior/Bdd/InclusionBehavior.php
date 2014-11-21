<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;

class InclusionBehavior extends MatcherBehavior
{
    /**
     * Validate against the InclusionMatcher.
     *
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function contain($expected, $message = "")
    {
        $this->validate($expected, $message);
    }
}
