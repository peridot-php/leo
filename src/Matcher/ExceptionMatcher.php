<?php

namespace Peridot\Leo\Matcher;

use Exception;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;
use Throwable;

/**
 * ExceptionMatcher executes a callable and determines if an exception of a given type was thrown. It optionally
 * matches the exception message.
 *
 * @package Peridot\Leo\Matcher
 */
class ExceptionMatcher implements MatcherInterface
{
    use MatcherTrait;

    /**
     * @param string $exceptionType
     */
    public function __construct($exceptionType)
    {
        $this->expected = $exceptionType;
    }

    /**
     * Set arguments to be passed to the callable.
     *
     * @param  array $arguments
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
     * @param  string $message
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

        if (!isset($this->template)) {
            return $this->getDefaultTemplate();
        }

        return $this->template;
    }

    /**
     * Set the template to be used when an expected exception message is provided.
     *
     * @param  TemplateInterface $template
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
        return new ArrayTemplate([
            'default' => 'Expected exception of type {{expected}}',
            'negated' => 'Expected type of exception not to be {{expected}}',
        ]);
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
            'negated' => 'Expected exception message {{actual}} not to equal {{expected}}',
        ]);
    }

    /**
     * Executes the callable and matches the exception type and exception message.
     *
     * @param $actual
     * @return Match
     */
    public function match($actual)
    {
        $this->validateCallable($actual);

        list($exception, $message) = $this->callableException($actual);
        $this->setMessage($message);

        return $this->matchMessage($actual, $exception, $message);
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
            throw new \BadFunctionCallException('Invalid callable ' . $callable . ' given');
        }
    }

    private function callableException($callable)
    {
        $exception = null;
        $message = null;

        try {
            call_user_func_array($callable, $this->arguments);
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            // fall-through ...
        } catch (Throwable $exception) {
            $message = $exception->getMessage();
            // fall-through ...
        }

        return array($exception, $message);
    }

    private function matchMessage($actual, $exception, $message)
    {
        if (!$this->expectedMessage || $message === $this->expectedMessage) {
            return $this->matchType($actual, $exception);
        }

        $isNegated = $this->isNegated();

        return new Match($isNegated, $this->expectedMessage, $message, $isNegated);
    }

    private function matchType($actual, $exception)
    {
        $isMatch = $exception instanceof $this->expected;
        $isNegated = $this->isNegated();

        return new Match($isMatch xor $isNegated, $this->expected, $actual, $isNegated);
    }

    /**
     * @var mixed
     */
    protected $expected;

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var string
     */
    protected $expectedMessage = '';

    /**
     * A captured exception message.
     *
     * @var string
     */
    protected $message;

    /**
     * @var TemplateInterface
     */
    protected $messageTemplate;
}
