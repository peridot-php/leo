<?php
namespace Peridot\Leo\Utility;

class ObjectPath
{
    /**
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
            $properties = $this->getPropertyCollection($properties[$key]);
        }
        return $pathValue;
    }

    /**
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
     * @param $subject
     * @return array
     */
    protected function getPropertyCollection($subject)
    {
        if (is_array($subject)) {
            return $subject;
        }

        return get_object_vars($subject);
    }

    /**
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
