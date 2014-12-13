<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * KeysMatcher determines if the actual array or object has the expected keys. If the Assertion has
 * a 'contain' flag set, it will check if the expected keys are included in the object or array.
 *
 * @package Peridot\Leo\Matcher
 */
class KeysMatcher extends AbstractMatcher
{
    /**
     * The verb used in the template. Uses "have" if the 'contain' flag is not used, otherwise
     * "contain" is used.
     *
     * @var string
     */
    protected $verb = 'have';

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        $subject = 'key';

        if (count($this->expected) > 1) {
            $subject = "keys";
        }

        $template = new ArrayTemplate([
            'default' => "Expected {{actual}} to {$this->verb} $subject {{keys}}",
            'negated' => "Expected {{actual}} to not {$this->verb} $subject {{keys}}"
        ]);

        return $template->setTemplateVars(['keys' => $this->getKeyString()]);
    }

    /**
     * Assert that the actual value is an array or object with the expected keys.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        $actual = $this->getArrayValue($actual);
        if ($this->assertion->flag('contain')) {
            $this->verb = 'contain';
            return $this->matchInclusion($actual);
        }
        $keys = array_keys($actual);
        return $keys == $this->expected;
    }

    /**
     * Normalize the actual value into an array, whether it is an object
     * or an array.
     *
     * @param object|array $actual
     */
    protected function getArrayValue($actual)
    {
        if (is_object($actual)) {
            return get_object_vars($actual);
        }

        if (is_array($actual)) {
            return $actual;
        }

        throw new \InvalidArgumentException("KeysMatcher expects object or array");
    }

    /**
     * Returns a formatted string of expected keys.
     *
     * @return string keys
     */
    protected function getKeyString()
    {
        $expected = $this->expected;
        $keys = '';
        $tail = array_pop($expected);

        if ($expected) {
            $keys = implode('","', $expected) . '", and "';
        }

        $keys .= $tail;

        return $keys;
    }

    /**
     * Used when the 'contain' flag exists on the Assertion. Checks
     * if the expected keys are included in the object or array.
     *
     * @param array $actual
     * @return true
     */
    protected function matchInclusion($actual)
    {
        foreach ($this->expected as $key) {
            if (!isset($actual[$key])) {
                return false;
            }
        }
        return true;
    }
}
