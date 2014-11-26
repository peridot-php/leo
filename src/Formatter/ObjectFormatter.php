<?php
namespace Peridot\Leo\Formatter;

/**
 * Class ObjectFormatter
 * @package Peridot\Leo\Formatter
 */
class ObjectFormatter 
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
