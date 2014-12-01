<?php
namespace Peridot\Leo\Responder;

use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\TemplateInterface;

interface ResponderInterface
{
    /**
     * @param Match $match
     * @param TemplateInterface $template
     * @return mixed
     */
    public function respond(Match $match, TemplateInterface $template);
} 
