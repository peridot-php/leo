<?php
namespace Peridot\Leo\Matcher;

abstract class CountableMatcher extends AbstractMatcher
{
    protected $countable;

    /**
     * @param mixed $countable
     * @return $this
     */
    public function setCountable($countable)
    {
        $this->countable = $countable;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual = null)
    {
        if (isset($this->countable)) {
            $actual = count($this->countable);
        }

        if (!is_numeric($actual)) {
            throw new \InvalidArgumentException(get_class($this) . " requires a numeric value");
        }

        return $this->matchNumeric($actual);
    }

    /**
     * Determine if a number matches a specified condition
     *
     * @param $number
     * @return bool
     */
    abstract protected function matchNumeric($number);
}
