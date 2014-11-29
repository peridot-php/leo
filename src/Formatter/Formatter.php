<?php
namespace Peridot\Leo\Formatter;

use Peridot\Leo\Matcher\Match;

class Formatter
{
    /**
     * @var Match
     */
    protected $match;

    /**
     * @param Match $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @param mixed $obj
     * @return string
     */
    public function objectToString($obj)
    {
        if ($obj === false) {
            return 'false';
        }

        if ($obj === true) {
            return 'true';
        }

        if (is_null($obj)) {
            return 'null';
        }

        if (is_string($obj)) {
            return '"' . $obj . '"';
        }

        return rtrim(print_r($obj, true));
    }
} 
