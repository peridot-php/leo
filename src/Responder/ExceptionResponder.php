<?php
namespace Peridot\Leo\Responder;

use Exception;
use Peridot\Leo\Formatter\FormatterInterface;
use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\TemplateInterface;

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
     * @param Match $match
     * @param TemplateInterface $template
     */
    public function respond(Match $match, TemplateInterface $template)
    {
        $this->formatter->setMatch($match);
        $message = $this->formatter->getMessage($template);
        throw new Exception($message);
    }
} 
