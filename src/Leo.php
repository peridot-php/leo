<?php
namespace Peridot\Leo;

use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Responder\ExceptionResponder;

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

        $core = include __DIR__ . '/Core/Definitions.php';
        $this->assertion->extend($core);
    }

    /**
     * @return Assertion
     */
    public function getAssertion()
    {
        return $this->assertion;
    }

    /**
     * @param Assertion $assertion
     */
    public function setAssertion($assertion)
    {
        $this->assertion = $assertion;
        return $this;
    }

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param Formatter $formatter
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
        return $this;
    }

    /**
     * @return ExceptionResponder
     */
    public function getResponder()
    {
        return $this->responder;
    }

    /**
     * @param ExceptionResponder $responder
     */
    public function setResponder($responder)
    {
        $this->responder = $responder;
        return $this;
    }

    /**
     * @return Leo
     */
    public static function instance()
    {
        if (! self::$instance) {
            self::$instance = new Leo();
        }
        return self::$instance;
    }
} 
