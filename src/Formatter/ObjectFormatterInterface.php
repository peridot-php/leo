<?php
namespace Peridot\Leo\Formatter;

/**
 * The ObjectFormatterInterface provides an interface
 * for formatting objects as strings.
 *
 * @package Peridot\Leo\Formatter
 */
interface ObjectFormatterInterface
{
    /**
     * @param mixed $object
     * @return string
     */
    public function format($object);
} 
