<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;
use Peridot\Leo\Flag\ContainFlag;
use Peridot\Leo\Flag\IncludeFlag;
use Peridot\Leo\Interfaces\AbstractBaseInterface;

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

    /**
     * @param AbstractBaseInterface $interface
     */
    public function extend(AbstractBaseInterface $interface)
    {
        $interface->setFlag(new ContainFlag());
        $interface->setFlag(new IncludeFlag());
    }
}
