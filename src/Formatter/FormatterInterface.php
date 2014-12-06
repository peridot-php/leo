<?php
namespace Peridot\Leo\Formatter;

use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\TemplateInterface;

interface FormatterInterface
{
    /**
     * @return Match
     */
    public function getMatch();

    /**
     * @param Match $match
     */
    public function setMatch(Match $match);

    /**
     * @param TemplateInterface $template
     * @return mixed|string
     */
    public function getMessage(TemplateInterface $template);

    /**
     * @param mixed $obj
     * @return string
     */
    public function objectToString($obj);
}
