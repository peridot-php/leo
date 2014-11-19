<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Matcher\TypeMatcher;
use Peridot\Scope\Scope;

class TypeBehavior extends Scope
{
    /**
     * @var TypeMatcher
     */
    protected $matcher;

    /**
     * @param AbstractBaseInterface $interface
     */
    public function __construct()
    {
        $this->matcher = new TypeMatcher();
    }

    /**
     * @param $subject
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function typeOf($subject, $expected, $message = "")
    {
        $this->matcher
            ->setSubject($subject)
            ->validate($expected, false, $message);
    }

    /**
     * @param $subject
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function notTypeOf($subject, $expected, $message = "")
    {
        $this->matcher
            ->setSubject($subject)
            ->validate($expected, true, $message);
    }
}
