<?php
namespace Peridot\Leo\Formatter;

/**
 * The ObjectFormatter is the default object formatter
 * for Leo.
 *
 * @package Peridot\Leo\Formatter
 */
class ObjectFormatter implements ObjectFormatterInterface
{
    /**
     * @return string
     */
    public function format($object)
    {
        if ($object === true) {
            return 'true';
        } elseif ($object === false) {
            return 'false';
        } elseif ($object === null) {
            return 'null';
        } elseif (is_string($object)) {
            return "\"{$object}\"";
        }

        return rtrim(print_r($object, true));
    }
} 
