<?php
use Peridot\Leo\LeoInterface;

function expect($actual) {
    return new LeoInterface($actual);
}
