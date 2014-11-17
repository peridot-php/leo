<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Matcher\TypeMatcher;
use Peridot\Scope\Scope;

class TypeBehavior extends Scope
{
    /**
     * @var AbstractBaseInterface
     */
    public $a;

    /**
     * @var AbstractBaseInterface
     */
    public $an;

    /**
     * @var TypeMatcher
     */
    protected $matcher;

    /**
     * @param AbstractBaseInterface $interface
     */
    public function __construct(AbstractBaseInterface $interface)
    {
        $this->matcher = new TypeMatcher();
        $this->matcher->setSubject($interface->getSubject());
        $this->interface = $interface;
        $this->a = $this->interface;
        $this->an = $this->interface;
    }

    /**
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function a($expected, $message = "")
    {
        $this->matcher->validate($expected, $this->interface->isNegated(), $message);
    }

    /**
     * @param $expected
     * @param $message
     */
    public function an($expected, $message)
    {
        $this->a($expected, $message);
    }
} 
