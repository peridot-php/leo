<?php
use Peridot\Leo\Assertion;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Responder\ExceptionResponder;

describe('Assertion', function() {
    beforeEach(function() {
        $formatter = new Formatter();
        $this->responder = new ExceptionResponder($formatter);
        $this->assertion = new Assertion($this->responder, 'actual');
        $this->assertion->addMethod('dynamicmethod', function($expected) {
            return new SameMatcher($expected);
        });
        $this->assertion->addMethod('nonmatcher', function($expected) {
            return $expected;
        });
    });

    describe('->getResponder()', function() {
        it('should return the Assertion responder', function() {
            expect($this->assertion->getResponder())->to->equal($this->responder);
        });
    });

    context('when calling a dynamic method', function() {
        it('should throw an exception if method does not exist', function() {
            expect([$this->assertion, 'notamethod'])->to->throw('BadMethodCallException');
        });

        it('should return the result of a non-matcher method', function() {
            $result = $this->assertion->nonmatcher(1);
            expect($result)->to->equal(1);
        });
    });

    context('when calling a dynamic property', function() {
        it('should throw an exception if property does not exist', function() {
            expect(function() {
                $nope = $this->assertion->nope;
            })->to->throw('DomainException');
        });

        it('should return a cached version of the property if it is memoized', function () {
            $this->assertion->addProperty('thing', function () {
                return new stdClass();
            }, true);

            $thing = $this->assertion->thing;
            $thingAgain = $this->assertion->thing;

            expect($thing)->to->equal($thingAgain);
        });
    });

    describe('->flag()', function() {
        it('should act as getter and setter', function() {
            $this->assertion->flag('not', true);
            expect($this->assertion->flag('not'))->to->equal(true);
        });

        it('should return null if flag does not exist', function() {
            $flag = $this->assertion->flag('nope');
            expect(is_null($flag))->to->equal(true);
        });
    });

    describe('->extend()', function() {
        it('should execute callable in a file', function() {
            $plugin = __DIR__ . '/fixtures/extend.php';
            $this->assertion->extend($plugin);
            expect($this->assertion->fixture())->to->equal(5);
        });

        it('should execute a passed in callable', function() {
            $this->assertion->extend(function($assertion) {
                $assertion->addMethod('fixture', function() {
                    return 4;
                });
            });
            expect($this->assertion->fixture())->to->equal(4);
        });

        it('should throw an exception if no callable given', function() {
            expect([$this->assertion, 'extend'])->with('string')->to->throw('InvalidArgumentException');
        });
    });
});
