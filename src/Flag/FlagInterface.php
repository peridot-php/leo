<?php
namespace Peridot\Leo\Flag;

use Peridot\Leo\Scope;

/**
 * FlagInterface is the main interface for setting state
 * on a Leo scope as the result of a property being accessed
 *
 * @package Peridot\Leo\Flag
 */
interface FlagInterface
{
    /**
     * Return a unique identifier for the flag. The id
     * will be used as the property name via scope.
     *
     * @return string
     */
    public function getId();

    /**
     * @param Scope $scope
     * @return mixed
     */
    public function __invoke(Scope $scope);
} 
