<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * TypeMatcher determines if an actual value has the same type as the expected type.
 *
 * @package Peridot\Leo\Matcher
 */
class TypeMatcher extends AbstractMatcher
{
    /**
     * @var string
     */
    protected $type;

    /**
     * {@inheritdoc}
     *
     * @param $actual
     * @return Match
     */
    public function match($actual)
    {
        $match = parent::match($actual);
        return $match->setActual($this->type);
    }

    /**
     * Determine if the actual value has the same type as the expected value. Uses the native gettype()
     * function to compare.
     *
     * @param $actual
     * @return bool
     */
    public function doMatch($actual)
    {
        $this->type = gettype($actual);
        return $this->expected === $this->type;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        return new ArrayTemplate([
            'default' => 'Expected {{expected}}, got {{actual}}',
            'negated' => 'Expected a type other than {{expected}}'
        ]);
    }
}
