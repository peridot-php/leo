<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Assertion;
use Peridot\Leo\Leo;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * AssertInterface is a non-chainable, object oriented interface
 * on top of a Leo Assertion.
 *
 * @package Peridot\Leo\Interfaces
 */
class AssertInterface
{
    /**
     * @var Assertion
     */
    protected $assertion;

    /**
     * @param ResponderInterface $responder
     */
    public function __construct(Assertion $assertion = null)
    {
        if (is_null($assertion)) {
            $assertion = Leo::instance()->getAssertion();
        }
        $this->assertion = $assertion;
    }

    /**
     * Perform an a loose equality assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function equal($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->loosely->equal($expected, $message);
    }

    /**
     * Perform a negated loose equality assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function notEqual($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->equal($expected, $message);
    }

    /**
     * Performs a throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function throws(callable $fn, $exceptionType, $exceptionMessage = "", $message = "")
    {
        $this->assertion->setActual($fn);
        $this->assertion->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Performs a negated throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function doesNotThrow(callable $fn, $exceptionType, $exceptionMessage = "", $message = "")
    {
        $this->assertion->setActual($fn);
        $this->assertion->not->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Performs a type assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function typeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->a($expected, $message);
    }

    /**
     * Performs a negated type assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function notTypeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->be->a($expected, $message);
    }
}
