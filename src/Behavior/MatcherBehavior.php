<?php
namespace Peridot\Leo\Behavior;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\MatcherInterface;
use Peridot\Scope\Scope;

/**
 * MatcherBehavior is the base class for Leo's default
 * matching behaviors. It extends scope to mix in methods
 * for matching and interface extension.
 *
 * @package Peridot\Leo\Behavior
 */
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
     * Validate that the expected value does not match against
     * the subject.
     *
     * @param $subject
     * @param $expected
     * @param string $message
     */
    public function validate()
    {
        list($subject, $expected, $message) = $this->getValidateArguments(func_get_args());
        $this->matcher->setSubject($subject);
        $this->matcher->validate($expected, $this->interface->isNegated(), $message);
    }

    /**
     * Negate the behavior's interface.
     *
     * @return $this
     */
    public function negate()
    {
        $this->interface->negated = true;
        return $this;
    }

    /**
     * A hook for extending an interface.
     *
     * @param AbstractBaseInterface $interface
     */
    public function extend(AbstractBaseInterface $interface)
    {

    }

    /**
     * Get args for matching.
     *
     * @param $args
     * @return array
     */
    protected function getValidateArguments($args)
    {
        if (count($args) === 3) {
            return $args;
        }
        array_unshift($args, $this->interface->getSubject());
        return $args;
    }
} 
