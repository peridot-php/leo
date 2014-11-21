<?php
namespace Peridot\Leo\Behavior\Assert;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Matcher\InclusionMatcher;
use Peridot\Scope\Scope;

class InclusionBehavior extends Scope
{
    /**
     * @var InclusionMatcher
     */
    protected $matcher;

    /**
     * @param AbstractBaseInterface $interface
     */
    public function __construct()
    {
        $this->matcher = new InclusionMatcher();
    }

    /**
     * @param $haystack
     * @param $needle
     * @param string $message
     */
    public function contain($haystack, $needle, $message = "")
    {
        $this->matcher
            ->setSubject($haystack)
            ->validate($needle, false, $message);
    }

    /**
     * @param $subject
     * @param $expected
     * @param string $message
     * @throws \Exception
     */
    public function notInclude($haystack, $needle, $message = "")
    {
        $this->matcher
            ->setSubject($haystack)
            ->validate($needle, true, $message);
    }
}
