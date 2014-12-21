<?php
namespace Peridot\Leo;

use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Formatter\FormatterInterface;
use Peridot\Leo\Responder\ExceptionResponder;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Class Leo. Singleton access to Leo and
 * all of its internals. A singleton is used as
 * opposed to static methods and properties because
 * of how php handles static closures.
 *
 * For instance:
 *
 * Leo::extend(callable $fn) will not allow binding
 * of variables inside $fn - i.e via the DynamicObjectTrait
 *
 * @package Peridot\Leo
 */
class Leo
{
    /**
     * @var \Peridot\Leo\Leo
     */
    private static $instance;

    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * @var ExceptionResponder
     */
    protected $responder;

    /**
     * @var Assertion
     */
    protected $assertion;

    /**
     * Private access Constructor
     */
    private function __construct()
    {
        $this->formatter = new Formatter();
        $this->responder = new ExceptionResponder($this->formatter);
        $this->assertion = new Assertion($this->responder);

        $this->assertion->extend(__DIR__ . '/Core/Definitions.php');
    }

    /**
     * Return the Leo Assertion.
     *
     * @return Assertion
     */
    public function getAssertion()
    {
        return $this->assertion;
    }

    /**
     * Set the Assertion used by Leo.
     *
     * @param $assertion
     * @return $this
     */
    public function setAssertion($assertion)
    {
        $this->assertion = $assertion;
        return $this;
    }

    /**
     * Return the FormatterInterface used by Leo.
     *
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * Set the FormatterInterface used by Leo.
     *
     * @param $formatter
     * @return $this
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
        return $this;
    }

    /**
     * Return the ResponderInterface being used by Leo.
     *
     * @return ResponderInterface
     */
    public function getResponder()
    {
        return $this->responder;
    }

    /**
     * Set the ResponderInterface used by Leo.
     *
     * @param $responder
     * @return $this
     */
    public function setResponder(ResponderInterface $responder)
    {
        $this->responder = $responder;
        return $this;
    }

    /**
     * Singleton access to Leo. A singleton is used instead of a facade as
     * PHP has some hangups about binding scope from static methods. This should
     * be used to access all Assertion members.
     *
     * @code
     *
     * $assertion = Leo::instance()->getAssertion();
     * $assertion->extend(function($assertion)) {
     *     $assertion->addMethod('coolAssertion', function($expected, $message = "") {
     *         $this->flag('message', $message);
     *         return new CoolMatcher($expected);
     *     });
     * });
     *
     * @endcode
     *
     * @return Leo
     */
    public static function instance()
    {
        if (! self::$instance) {
            self::$instance = new Leo();
        }
        return self::$instance;
    }

    /**
     * Singleton access to Leo's assertion object.
     *
     * @return Assertion
     */
    public static function assertion()
    {
        return Leo::instance()->getAssertion();
    }
}
