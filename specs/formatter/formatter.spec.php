<?php
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\Match;

describe('Formatter', function() {
    beforeEach(function() {
        $match = new Match(false, 4, 3, false);
        $this->formatter = new Formatter($match);
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
});
