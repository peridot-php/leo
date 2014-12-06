<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class GreaterThanMatcher extends AbstractMatcher
{
    protected $countable;

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

        if (! is_numeric($actual)) {
            throw new \InvalidArgumentException("GreaterThanMatcher requires a numeric value");
        }

        return $actual > $this->expected;
    }

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
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        $default = 'Expected {{actual}} to be above {{expected}}';
        $negated = 'Expected {{actual}} to be at most {{expected}}';

        if (isset($this->countable)) {
            $count = count($this->countable);
            $default = "Expected {{actual}} to have a length above {{expected}} but got $count";
            $negated = "Expected {{actual}} to not have a length above {{expected}}";
        }

        return new ArrayTemplate([
            'default' => $default,
            'negated' => $negated
        ]);
    }
}
