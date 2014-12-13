<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Assertion;
use Peridot\Leo\DynamicObjectTrait;
use Peridot\Leo\Leo;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Class AssertInterface
 * @package Peridot\Leo\Interfaces
 */
class AssertInterface
{
    use DynamicObjectTrait;

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
        include __DIR__ . '/interface.assert.php';
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
