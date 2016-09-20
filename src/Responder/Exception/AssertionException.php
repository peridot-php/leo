<?php

namespace Peridot\Leo\Responder\Exception;

use Exception;
use ReflectionClass;

/**
 * Thrown by ExceptionResponder when an assertion fails.
 *
 * @package Peridot\Leo\Responder\Exception
 */
final class AssertionException extends Exception
{
    /**
     * Trim the supplied exception's stack trace to only include relevant
     * information.
     *
     * Also replaces the file path and line number.
     *
     * @param Exception $exception The exception.
     */
    public static function trim(Exception $exception)
    {
        $reflector = new ReflectionClass('Exception');

        $traceProperty = $reflector->getProperty('trace');
        $traceProperty->setAccessible(true);
        $fileProperty = $reflector->getProperty('file');
        $fileProperty->setAccessible(true);
        $lineProperty = $reflector->getProperty('line');
        $lineProperty->setAccessible(true);

        $call = static::traceLeoCall($traceProperty->getValue($exception));

        if ($call) {
            $traceProperty->setValue($exception, array($call));
            $fileProperty->setValue(
                $exception,
                isset($call['file']) ? $call['file'] : null
            );
            $lineProperty->setValue(
                $exception,
                isset($call['line']) ? $call['line'] : null
            );
        } else {
            $traceProperty->setValue($exception, array());
            $fileProperty->setValue($exception, null);
            $lineProperty->setValue($exception, null);
        }
    }

    /**
     * Find the Leo entry point call in a stack trace.
     *
     * @param array $trace The stack trace.
     *
     * @return array|null The call, or null if unable to determine the entry point.
     */
    public static function traceLeoCall(array $trace)
    {
        $prefix = 'Peridot\\Leo\\';

        for ($i = count($trace) - 1; $i >= 0; --$i) {
            $entry = $trace[$i];

            if (isset($entry['class'])) {
                if (0 === strpos($entry['class'], $prefix)) {
                    return $entry;
                }
            } elseif (0 === strpos($entry['function'], $prefix)) {
                return $entry;
            }
        }

        return null;
    }

    /**
     * Construct a new assertion exception.
     *
     * @param string $message The message.
     */
    public function __construct($message)
    {
        parent::__construct($message);

        static::trim($this);
    }
}
