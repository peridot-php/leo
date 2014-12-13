<?php
namespace Peridot\Leo\Responder;

use Exception;
use Peridot\Leo\Formatter\FormatterInterface;
use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * The ExceptionResponder responds to a match by throwing an exception
 * on a failed match.
 *
 * @package Peridot\Leo\Responder
 */
class ExceptionResponder implements ResponderInterface
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * {@inheritdoc}
     *
     * Throws an exception containing the formatted message.
     *
     * @param Match $match
     * @param TemplateInterface $template
     * @param string $message
     * @return void
     * @throws Exception
     */
    public function respond(Match $match, TemplateInterface $template, $message = "")
    {
        if ($match->isMatch()) {
            return;
        }

        $this->formatter->setMatch($match);
        $message = ($message) ? $message : $this->formatter->getMessage($template);
        throw new Exception($message);
    }
}
