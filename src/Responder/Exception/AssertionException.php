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
        $call = static::traceLeoCall($traceProperty->getValue($exception));

        if ($call) {
            $trace = array($call);
            list($file, $line) = self::traceCallPosition($call);
        } else {
            $trace = array();
            $file = null;
            $line = null;
        }

        $traceProperty->setValue($exception, $trace);
        self::updateExceptionPosition($reflector, $exception, $file, $line);
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
        for ($i = count($trace) - 1; $i >= 0; --$i) {
            if (self::isLeoTraceEntry($trace[$i])) {
                return $trace[$i];
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

    private static function isLeoTraceEntry($entry)
    {
        $prefix = 'Peridot\\Leo\\';

        if (isset($entry['class'])) {
            return 0 === strpos($entry['class'], $prefix);
        }

        return 0 === strpos($entry['function'], $prefix);
    }

    private static function traceCallPosition($call)
    {
        return array(
            isset($call['file']) ? $call['file'] : null,
            isset($call['line']) ? $call['line'] : null,
        );
    }

    private static function updateExceptionPosition($reflector, $exception, $file, $line)
    {
        $fileProperty = $reflector->getProperty('file');
        $fileProperty->setAccessible(true);
        $fileProperty->setValue($exception, $file);

        $lineProperty = $reflector->getProperty('line');
        $lineProperty->setAccessible(true);
        $lineProperty->setValue($exception, $line);
    }
}
