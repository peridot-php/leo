<?php
namespace Peridot\Leo\Flag;

class IncludeFlag extends ContainFlag
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getId()
    {
        return 'include';
    }
}
