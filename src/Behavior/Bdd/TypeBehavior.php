<?php
namespace Peridot\Leo\Behavior\Bdd;

use Peridot\Leo\Behavior\MatcherBehavior;
use Peridot\Leo\Interfaces\AbstractBaseInterface;

class TypeBehavior extends MatcherBehavior
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
     * @param AbstractBaseInterface $interface
     */
    public function extend(AbstractBaseInterface $interface)
    {
        $this->a = $interface;
        $this->an = $interface;
    }

    /**
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function a($expected, $message = "")
    {
        $this->validate($expected, $message);
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
