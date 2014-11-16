<?php
namespace Peridot\Leo\Flag;


use Peridot\Scope\Scope;

class NotFlag implements FlagInterface
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getId()
    {
        return 'not';
    }

    /**
     * @param Scope $scope
     * @return mixed
     */
    public function __invoke(Scope $scope)
    {
        $scope->negated = true;
        return $scope;
    }
}
