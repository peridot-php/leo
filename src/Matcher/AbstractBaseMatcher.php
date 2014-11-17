<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Interfaces\Bdd;
use Peridot\Scope\Scope;

abstract class AbstractBaseMatcher extends Scope implements MatcherInterface
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected, $actual)
    {
        return $expected === $actual;
    }

    /**
     * Return the subject of the assertion.
     *
     * @return AbstractBaseInterface
     */
    public function getInterface()
    {
        return $this->peridotGetParentScope();
    }

    /**
     * Validate the match and throw an exception if validation
     * fails.
     *
     * @param $type
     * @param $actual
     * @param string $message - an optional message
     * @throws \Exception
     */
    public function validate($expected, $actual, $message = "")
    {
        $validation = $this->isMatch($expected, $actual);
        $negated = $this->getInterface()->isNegated();

        if ($negated) {
            $validation = !$validation;
        }

        if ($validation) {
            return;
        }

        if (! $message) {
            $message = $this->getMessage($expected, $actual, $negated);
        }

        throw new \Exception($message);
    }

    /**
     * Checks interface and calls appropriate interface definition
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($this->getInterface() instanceof Bdd) {
            return $this->asBdd($name, $arguments);
        }
        return parent::__call($name, $arguments);
    }

    /**
     * Define how a matcher responds to a Bdd interface.
     *
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    abstract protected function asBdd($methodName, $arguments);
}
