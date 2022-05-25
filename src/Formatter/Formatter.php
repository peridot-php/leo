<?php

namespace Peridot\Leo\Formatter;

use Peridot\Leo\Matcher\MatchClass;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * Class Formatter is the core FormatterInterface for Leo.
 *
 * @package Peridot\Leo\Formatter
 */
class Formatter implements FormatterInterface
{
    /**
     * @var MatchClass
     */
    protected $match;

    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @return MatchClass
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * {@inheritdoc}
     *
     * @param  MatchClass $match
     * @return $this
     */
    public function setMatch(MatchClass $match)
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
        switch (gettype($obj)) {
            case 'boolean':
                return var_export($obj, true);

            case 'NULL':
                return 'null';

            case 'string':
                return '"' . $obj . '"';
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
