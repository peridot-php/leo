<?php
namespace Peridot\Leo\Flag;

use Peridot\Scope\Scope;

class ContainFlag implements FlagInterface
{
    /**
     * @var bool
     */
    protected $isEnabled = false;

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getId()
    {
        return 'contain';
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param Scope $scope
     * @return mixed
     */
    public function __invoke(Scope $scope)
    {
        $this->isEnabled = true;
        return $scope;
    }
}
