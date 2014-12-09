<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

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
     * @return mixed
     */
    public function getCountable()
    {
        return $this->countable;
    }

    /**
     * Get the count of the countable value.
     * @return int
     */
    public function getCount()
    {
        if (is_string($this->countable)) {
            return strlen($this->countable);
        }

        return count($this->countable);
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if (isset($this->countable)) {
            return $this->getDefaultCountableTemplate();
        }

        return parent::getTemplate();
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
            $actual = $this->getCount();
        }

        if (!is_numeric($actual)) {
            throw new \InvalidArgumentException(get_class($this) . " requires a numeric value");
        }

        return $this->matchNumeric($actual);
    }

    /**
     * Return a default template for when a countable has been set.
     *
     * @return TemplateInterface
     */
    abstract public function getDefaultCountableTemplate();

    /**
     * Determine if a number matches a specified condition
     *
     * @param $number
     * @return bool
     */
    abstract protected function matchNumeric($number);
}
