<?php
namespace Peridot\Leo\Interfaces;

/**
 * An interface that has no subject and does nothing.
 *
 * @package Peridot\Leo\Interfaces
 */
class NullInterface extends AbstractBaseInterface
{
    public function __construct()
    {
        $this->subject = null;
    }
}
