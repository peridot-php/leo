<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Assertion;
use Peridot\Leo\DynamicMethodTrait;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Class AssertInterface
 * @package Peridot\Leo\Interfaces
 */
class AssertInterface
{
    use DynamicMethodTrait;

    /**
     * @var Assertion
     */
    protected $assertion;

    /**
     * @param ResponderInterface $responder
     */
    public function __construct(ResponderInterface $responder)
    {
        $interface = $this;
        include __DIR__ . '/assert.interface.php';
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array($this->methods[$method], $args);
    }
} 
