<?php
namespace Peridot\Leo\Interfaces\Assert;

use Countable;

/**
 * CollectionAssertTrait contains assertions that primarily
 * deal with collections and countable values.
 *
 * @package Peridot\Leo\Interfaces\Assert
 */
trait CollectionAssertTrait
{
    /**
     * Perform a length assertion.
     *
     * @param string|array|Countable $countable
     * @param $length
     * @param string $message
     */
    public function lengthOf($countable, $length, $message = "")
    {
        $this->assertion->setActual($countable);
        return $this->assertion->to->have->length($length, $message);
    }

    /**
     * Perform an inclusion assertion.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function isIncluded($haystack, $needle, $message = "")
    {
        $this->assertion->setActual($haystack);
        return $this->assertion->to->include($needle, $message);
    }

    /**
     * Perform a negated inclusion assertion.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function notInclude($haystack, $needle, $message = "")
    {
        $this->assertion->setActual($haystack);
        return $this->assertion->to->not->include($needle, $message);
    }
}
