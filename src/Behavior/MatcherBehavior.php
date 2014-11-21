<?php
namespace Peridot\Leo\Behavior;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\MatcherInterface;
use Peridot\Scope\Scope;

abstract class MatcherBehavior extends Scope
{
    /**
     * @var MatcherInterface
     */
    protected $matcher;

    /**
     * @param MatcherInterface $matcher
     */
    public function __construct(MatcherInterface $matcher, AbstractBaseInterface $interface = null)
    {
        $this->matcher = $matcher;
        $this->interface = $interface ?: new NullInterface();
        $this->matcher->setSubject($this->interface->getSubject());
        $this->extend($interface);
    }

    /**
     * Validate that the expected value is matched against
     * subject.
     *
     * @param $subject
     * @param $expected
     * @param string $message
     */
    public function validate($subject, $expected, $message = "")
    {
        $subject = $this->interface->getSubject();
        $expected = func_get_arg(0);
        $message = func_get_arg(1);
        if (func_num_args() == 3) {
            $subject = func_get_arg(0);
            $expected = func_get_arg(1);
            $message = func_get_arg(2);
        }
        $this->matcher->setSubject($subject);
        $this->matcher->validate($expected, false, $message);
    }

    /**
     * Validate that the expected value does not match against
     * the subject.
     *
     * @param $subject
     * @param $expected
     * @param string $message
     */
    public function negate()
    {
        $subject = $this->interface->getSubject();
        $expected = func_get_arg(0);
        $message = func_get_arg(1);
        if (func_num_args() == 3) {
            $subject = func_get_arg(0);
            $expected = func_get_arg(1);
            $message = func_get_arg(2);
        }
        $this->matcher->setSubject($subject);
        $this->matcher->validate($expected, true, $message);
    }

    /**
     * A hook for extending an interface.
     *
     * @param AbstractBaseInterface $interface
     */
    public function extend(AbstractBaseInterface $interface)
    {

    }
} 
