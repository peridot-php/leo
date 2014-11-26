<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Formatter\ObjectFormatter;

abstract class AbstractBaseMatcher implements MatcherInterface
{
    /**
     * @var mixed
     */
    protected $actual;

    /**
     * Validate the match and throw an exception if validation
     * fails.
     *
     * @param $type
     * @param string $message - an optional message
     * @throws \Exception
     */
    public function validate($expected, $negated, $message = "")
    {
        $validation = $this->isMatch($expected);

        if ($negated) {
            $validation = !$validation;
        }

        if ($validation) {
            return;
        }

        if (! $message) {
            $message = $this->getMessage($expected, $this->getActual(), $negated);
        }

        throw new \Exception($message);
    }

    /**
     * {@inheritdoc}
     *
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->actual = $subject;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Return a string representation of an object.
     *
     * @param mixed $obj
     */
    protected function objectToString($obj)
    {
        $formatter = new ObjectFormatter();
        return $formatter->format($obj);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    abstract public function isMatch($expected);
}
