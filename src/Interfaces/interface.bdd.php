<?php

use Peridot\Leo\Leo;

function expect($actual)
{
    $instance = Leo::instance();
    $assertion = $instance->getAssertion();
    return $assertion->setActual($actual);
}
