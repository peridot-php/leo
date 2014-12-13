<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * ExceptionMatcher executes a callable and determines if an exception of a given type was thrown. It optionally
 * matches the exception message.
 *
 * @package Peridot\Leo\Matcher
 */
class ExceptionMatcher extends AbstractMatcher
{
    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var string
     */
    protected $expectedMessage = "";

    /**
     * A captured exception message
     *
     * @var string $message
     */
    protected $message;

    /**
     * @var TemplateInterface
     */
    protected $messageTemplate;

    /**
     * @param callable $expected
     */
    public function __construct($exceptionType)
    {
        $this->expected = $exceptionType;
    }

    /**
     * Set arguments to be passed to the callable.
     *
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * Set the expected message of the exception.
     *
     * @param string $message
     * @return $this
     */
    public function setExpectedMessage($message)
    {
        $this->expectedMessage = $message;
        return $this;
    }

    /**
     * Set the message thrown from an exception resulting from the
     * callable being invoked.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Returns the arguments passed to the callable.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Return the expected exception message.
     *
     * @return string
     */
    public function getExpectedMessage()
    {
        return $this->expectedMessage;
    }

    /**
     * Return the message thrown by an exception resulting from the callable
     * being invoked.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     *
     * If the expected message has been set, the message template will be used.
     *
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if ($this->expectedMessage) {
            return $this->getMessageTemplate();
        }
        return parent::getTemplate();
    }

    /**
     * Set the template to be used when an expected exception message is provided.
     *
     * @param TemplateInterface $template
     * @return $this
     */
    public function setMessageTemplate(TemplateInterface $template)
    {
        $this->messageTemplate = $template;
        return $this;
    }

    /**
     * Return a template for rendering exception message templates.
     *
     * return TemplateInterface
     */
    public function getMessageTemplate()
    {
        if ($this->messageTemplate) {
            return $this->messageTemplate;
        }
        return $this->getDefaultMessageTemplate();
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        $template = new ArrayTemplate([
            'default' => 'Expected exception of type {{expected}}',
            'negated' => 'Expected type of exception not to be {{expected}}'
        ]);

        return $template;
    }

    /**
     * Return a default template for exception message assertions.
     *
     * @return ArrayTemplate
     */
    public function getDefaultMessageTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected exception message {{expected}}, got {{actual}}',
            'negated' => 'Expected exception message {{expected}} not to equal {{actual}}'
        ]);
    }

    /**
     * Override match to set actual and expect match values to message
     * values.
     *
     * @param $actual
     * @return Match
     */
    public function match($actual)
    {
        $match = parent::match($actual);
        if ($this->expectedMessage) {
            $match->setActual($this->message);
            $match->setExpected($this->expectedMessage);
        }
        return $match;
    }

    /**
     * Executes the callable and matches the exception type and exception message.
     *
     * @param $actual
     * @return bool
     */
    protected function doMatch($actual)
    {
        $this->validateCallable($actual);
        try {
            call_user_func_array($actual, $this->arguments);
            return false;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if ($this->expectedMessage) {
                $this->setMessage($message);
                return $this->expectedMessage == $message;
            }
            if (!$e instanceof $this->expected) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validate that expected is indeed a valid callable.
     *
     * @throws \BadFunctionCallException
     */
    protected function validateCallable($callable)
    {
        if (!is_callable($callable)) {
            $callable = rtrim(print_r($callable, true));
            throw new \BadFunctionCallException("Invalid callable " . $callable . " given");
        }
    }
}
