<?php
use Peridot\Leo\Behavior\Bdd\{{name}}Behavior;
use Peridot\Leo\Interfaces\NullInterface;
use Peridot\Leo\Matcher\{{name}}Matcher;

describe('Bdd\{{name}}Behavior', function() {

    beforeEach(function() {
        $matcher = new {{name}}Matcher();
        $this->interface = new NullInterface();
        $this->interface->setSubject([]);
        $this->subject = new {{name}}Behavior($matcher, $this->interface);
    });

    include __DIR__ . '/../../shared/behaviors/bdd/has-{{behavior}}-behavior.php';
});
