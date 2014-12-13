<?php
namespace Peridot\Leo\Matcher;

use Countable;
use InvalidArgumentException;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * LengthMatcher determines if an actual array, string, or Countable has a length equivalent
 * to the expected value.
 *
 * @package Peridot\Leo\Matcher
 */
class LengthMatcher extends AbstractMatcher
{
    /**
     * @var int
     */
    protected $count;

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        $template = new ArrayTemplate([
            'default' => 'Expected {{actual}} to have a length of {{expected}} but got {{count}}',
            'negated' => 'Expected {{actual}} to not have a length of {{expected}}'
        ]);

        return $template->setTemplateVars(['count' => $this->count]);
    }

    /**
     * Match the length of the countable interface or string against
     * the expected value.
     *
     * @param string|array|Countable $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        if ($this->isCountable($actual)) {
            $this->count = count($actual);
        }

        if (is_string($actual)) {
            $this->count = strlen($actual);
        }

        if (isset($this->count)) {
            return $this->expected === $this->count;
        }

        throw new InvalidArgumentException("Length matcher requires a string, array, or Countable");
    }

    /**
     * Determine if the native count() function can return a valid result
     * on the actual value.
     *
     * @param mixed $actual
     * @return bool
     */
    protected function isCountable($actual)
    {
        return is_array($actual) || $actual instanceof Countable;
    }
}
