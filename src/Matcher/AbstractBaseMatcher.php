<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Formatter\ObjectFormatterInterface;

abstract class AbstractBaseMatcher implements MatcherInterface
{
    /**
     * @var mixed
     */
    protected $actual;

    /**
     * @var ObjectFormatterInterface
     */
    protected $formatter;

    /**
     * @param ObjectFormatterInterface $formatter
     */
    public function __construct(ObjectFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

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
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    abstract public function isMatch($expected);
}
