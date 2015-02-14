<?php
namespace Peridot\Leo\ObjectPath;

/**
 * ObjectPath is a utility for parsing object and array strings into
 * ObjectPathValues.
 *
 * @package Peridot\Leo\Utility
 */
class ObjectPath
{
    /**
     * The subject to match path expressions against.
     *
     * @var array|object
     */
    protected $subject;

    /**
     * A pattern for matching array keys
     *
     * @var string
     */
    private static $arrayKey = '/\[([^\]]+)\]/';

    /**
     * @param array|object $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Returns an ObjectPathValue if the property described by $path
     * can be located in the subject.
     *
     * A path expression uses object and array syntax.
     *
     * @code
     *
     * $person = new stdClass();
     * $person->name = new stdClass();
     * $person->name->first = 'brian';
     * $person->name->last = 'scaturro';
     * $person->hobbies = ['programming', 'reading', 'board games'];
     *
     * $path = new ObjectPath($person);
     * $first = $path->get('name->first');
     * $reading = $path->get('hobbies[0]');
     *
     * @endcode
     *
     * @param string $path
     * @return ObjectPathValue
     */
    public function get($path)
    {
        $parts = $this->getPathParts($path);
        $properties = $this->getPropertyCollection($this->subject);
        $pathValue = null;
        while ($properties && $parts) {
            $key = array_shift($parts);
            $key = $this->normalizeKey($key);
            $pathValue = array_key_exists($key, $properties) ? new ObjectPathValue($key, $properties[$key]) : null;

            if (! array_key_exists($key, $properties)) {
                break;
            }

            $properties = $this->getPropertyCollection($properties[$key]);
        }
        return $pathValue;
    }

    /**
     * Breaks a path expression into an array used
     * for navigating a path.
     *
     * @param $path
     * @return array
     */
    public function getPathParts($path)
    {
        $path = preg_replace('/\[/', '->[', $path);
        if (preg_match('/^->/', $path)) {
            $path = substr($path, 2);
        }

        return explode('->', $path);
    }

    /**
     * Returns a property as an array.
     *
     * @param $subject
     * @return array
     */
    protected function getPropertyCollection($subject)
    {
        if (is_object($subject)) {
            return get_object_vars($subject);
        }

        return $subject;
    }

    /**
     * Return a key that can be used on the current subject.
     *
     * @param $key
     * @param $matches
     * @return mixed
     */
    protected function normalizeKey($key)
    {
        if (preg_match(static::$arrayKey, $key, $matches)) {
            $key = $matches[1];
            return $key;
        }
        return $key;
    }
}
