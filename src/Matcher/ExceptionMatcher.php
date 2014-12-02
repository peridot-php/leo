<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

class ExceptionMatcher extends AbstractMatcher
{
    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var string
     */
    protected $type;

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
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setExpectedMessage($message)
    {
        $this->expectedMessage = $message;
        return $this;
    }

    /**
     * Set the message from an exception.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if ($this->message) {
            return $this->getMessageTemplate();
        }
        return parent::getTemplate();
    }

    /**
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
     * {@inheritdoc}
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
            if ($this->expectedMessage && $this->expectedMessage != $message) {
                $this->setMessage($message);
                return false;
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
