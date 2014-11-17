<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Scope\Scope;

class InclusionBehavior extends Scope
{
    /**
     * @var InclusionMatcher
     */
    protected $matcher;

    /**
     * @param AbstractBaseInterface $interface
     */
    public function __construct(AbstractBaseInterface $interface)
    {
        $this->matcher = new InclusionMatcher();
        $this->matcher->setSubject($interface->getSubject());
        $this->interface = $interface;
    }

    public function contain($expected, $message = "")
    {
        $this->matcher->validate($expected, $this->interface->isNegated(), $message);
    }
} 
