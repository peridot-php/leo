<?php

namespace Peridot\Leo\Responder;

use Peridot\Leo\Matcher\MatchClass;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * The ResponderInterface is responsible for responding
 * to match results.
 *
 * @package Peridot\Leo\Responder
 */
interface ResponderInterface
{
    /**
     * Respond to a MatchClass given a TemplateInterface to format the message.
     *
     * @param  MatchClass             $match
     * @param  TemplateInterface $template
     * @param  string            $message  a user provided messaged
     * @return mixed
     */
    public function respond(MatchClass $match, TemplateInterface $template, $message);
}
