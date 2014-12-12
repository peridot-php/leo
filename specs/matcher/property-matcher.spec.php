<?php
use Peridot\Leo\Assertion;
use Peridot\Leo\Matcher\PropertyMatcher;

describe('PropertyMatcher', function() {
    beforeEach(function() {
        $this->matcher = new PropertyMatcher('name');
        $response = $this->getProphet()->prophesize('Peridot\Leo\Responder\ResponderInterface');
        $this->assertion = new Assertion($response->reveal());
        $this->matcher->setAssertion($this->assertion);
    });

    describe('->match()', function() {
        it('should return a true result if actual value has the given property', function() {
            $actual = new stdClass();
            $actual->name = "brian";
            $result = $this->matcher->match($actual);
            expect($result->isMatch())->to->be->true;
        });

        it('should return false if actual value does not have the given property', function() {
            $actual = new stdClass();
            $result = $this->matcher->match($actual);
            expect($result->isMatch())->to->be->false;
        });

        it('should return true if actual value has property with matching value', function() {
            $actual = new stdClass();
            $actual->name = "brian";
            $result = $this->matcher
                ->setValue("brian")
                ->match($actual);
            expect($result->isMatch())->to->be->true;
        });

        it('should return false if actual value has property with incorrect value', function() {
            $actual = new stdClass();
            $actual->name = "brian";
            $result = $this->matcher
                ->setValue("ryan")
                ->match($actual);
            expect($result->isMatch())->to->be->false;
        });

        context('when matching against an array', function() {

            beforeEach(function() {
                $this->matcher = new PropertyMatcher(1);
                $this->matcher->setAssertion($this->assertion);
            });

            it('should return true if array has index', function() {
                $actual = [1,2];
                $result = $this->matcher->match($actual);
                expect($result->isMatch())->to->be->true;
            });

            it('should return false if array does not have index', function() {
                $actual = [1];
                $result = $this->matcher->match($actual);
                expect($result->isMatch())->to->be->false;
            });

            it('should return true if array has index with matching value', function() {
                $actual = [1,3];
                $result = $this->matcher
                    ->setValue(3)
                    ->match($actual);
                expect($result->isMatch())->to->be->true;
            });

            it('should return false if array has index without matching value', function() {
                $actual = [1,3];
                $result = $this->matcher
                    ->setValue(4)
                    ->match($actual);
                expect($result->isMatch())->to->be->false;
            });
        });

        context('when actual is not an array or object', function() {
            it('should throw an exception', function() {
                expect([$this->matcher, 'match'])
                    ->with('string')->to->throw('InvalidArgumentException');
            });
        });
    });
});
