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
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if (isset($this->template)) {
            return $this->template;
        }

        if (isset($this->countable)) {
            return $this->getDefaultCountableTemplate();
        }

        return $this->getDefaultTemplate();
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
