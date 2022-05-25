<?php

namespace Peridot\Leo\Formatter;

use Peridot\Leo\Matcher\MatchClass;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * FormatterInterface defines an interface for formatting match results.
 *
 * @package Peridot\Leo\Formatter
 */
interface FormatterInterface
{
    /**
     * Return the match being formatted.
     *
     * @return MatchClass
     */
    public function getMatch();

    /**
     * Set the match to format results for.
     *
     * @param MatchClass $match
     */
    public function setMatch(MatchClass $match);

    /**
     * Applies the match to the given TemplateInterface
     * and return a formatted string.
     *
     * @param  TemplateInterface $template
     * @return mixed|string
     */
    public function getMessage(TemplateInterface $template);

    /**
     * Should return a string representation for any
     * PHP type.
     *
     * @param  mixed  $obj
     * @return string
     */
    public function objectToString($obj);
}
