<?php

namespace Peridot\Leo\Formatter;

use Exception;
use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\TemplateInterface;
use Throwable;

/**
 * Class Formatter is the core FormatterInterface for Leo.
 *
 * @package Peridot\Leo\Formatter
 */
class Formatter implements FormatterInterface
{
    /**
     * @var Match
     */
    protected $match;

    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @return Match
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * {@inheritdoc}
     *
     * @param  Match $match
     * @return $this
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param  TemplateInterface $template
     * @return mixed|string
     */
    public function getMessage(TemplateInterface $template)
    {
        $vars = $this->getTemplateVars($template);

        $tpl = $this->match->isNegated()
            ? $template->getNegatedTemplate()
            : $template->getDefaultTemplate();

        foreach ($vars as $name => $value) {
            $tpl = str_replace('{{' . $name . '}}', $this->objectToString($value), $tpl);
        }

        return $tpl;
    }

    /**
     * {@inheritdoc}
     *
     * @param  mixed  $obj
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

        if ($obj === null) {
            return 'null';
        }

        if (is_string($obj)) {
            return '"' . $obj . '"';
        }

        if ($obj instanceof Throwable || $obj instanceof Exception) {
            return get_class($obj) . ' Exception("' . $obj->getMessage() . '")';
        }

        return rtrim(print_r($obj, true));
    }

    /**
     * Applies match results to other template variables.
     *
     * @param  TemplateInterface $template
     * @return array
     */
    protected function getTemplateVars(TemplateInterface $template)
    {
        $vars = [
            'expected' => $this->match->getExpected(),
            'actual' => $this->match->getActual(),
        ];

        if ($tplVars = $template->getTemplateVars()) {
            $vars = array_merge($vars, $tplVars);
        }

        return $vars;
    }
}
