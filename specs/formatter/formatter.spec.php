<?php
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

describe('Formatter', function() {
    beforeEach(function() {
        $this->formatter = new Formatter();
    });

    describe('match accessors', function() {
        it('should allow access to match', function() {
            $match = new Match(false, 4, 3, false);
            $this->formatter->setMatch($match);
            expect($this->formatter->getMatch())->to->equal($match);
        });
    });

    describe('->objectToString()', function() {
        it('should return "false" for false', function() {
            $string = $this->formatter->objectToString(false);
            expect($string)->to->equal('false');
        });

        it('should return "true" for true', function() {
            $string = $this->formatter->objectToString(true);
            expect($string)->to->equal('true');
        });

        it('should return "null" for null', function() {
            $string = $this->formatter->objectToString(null);
            expect($string)->to->equal('null');
        });

        it('should return quoted string for string', function() {
            $string = $this->formatter->objectToString('hello');
            expect($string)->to->equal('"hello"');
        });

        it('should format other objects using print_r', function() {
            $obj = new stdClass();
            $obj->first = "brian";
            $string = $this->formatter->objectToString($obj);
            expect($string)->to->equal("stdClass Object\n(\n    [first] => brian\n)");
        });
    });

    describe('->getMessage()', function() {

        beforeEach(function() {
            $this->template = new ArrayTemplate([
                'default' => 'Expected {{expected}}, got {{actual}}',
                'negated' => 'Expected {{expected}} not to be {{actual}}'
            ]);
        });

        it('should return a default message based on a template', function() {
            $match = new Match(false, 4, 3, false);
            $message = $this->formatter->setMatch($match)->getMessage($this->template);
            expect($message)->to->equal('Expected 4, got 3');
        });

        it('should return a negated message based on a template', function() {
            $match = new Match(false, 4, 4, true);
            $message = $this->formatter->setMatch($match)->getMessage($this->template);
            expect($message)->to->equal('Expected 4 not to be 4');
        });
    });
});
