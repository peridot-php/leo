<?php
use Peridot\Leo\BddInterface;

function expect($actual) {
    return new BddInterface($actual);
}
