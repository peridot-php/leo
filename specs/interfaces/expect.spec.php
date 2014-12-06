<?php
describe('expect', function() {
    describe('->equal()', function() {
        it('should match objects that are the same', function() {
            $obj = new stdClass;
            expect($obj)->to->equal($obj);
        });

        it('should throw an exception when objects are different', function() {
            $actual = new stdClass;
            $expected = new stdClass;
            $interface = expect($actual)->to;
            expect([$interface, 'equal'])->with($expected)->to->throw('Exception');
        });

        it('should throw a user specified exception message if provided', function() {
            $actual = new stdClass;
            $expected = new stdClass;
            $interface = expect($actual)->to;
            expect([$interface, 'equal'])->with($expected, "Such failure")->to->throw('Exception', 'Such failure');
        });

        context('when negated', function() {
            it('should throw an exception if values are equal', function() {
                $actual = $expected = new stdClass;
                $assertion = expect($actual)->not->to;
                expect(function() use ($assertion, $expected) {
                    $assertion->equal($expected);
                })->to->throw('Exception');
            });
        });
    });

    describe('->throw()', function() {
        it('should match when function throws exception', function() {
            expect(function() {
                throw new Exception("ooooops");
            })->to->throw('Exception');
        });

        it('should allow user exception message', function() {
            expect(function() {
                expect(function() {
                    throw new RuntimeException("ooooops");
                })->to->throw('DomainException', "", "wrong type");
            })->to->throw("Exception", "wrong type");
        });

        context('when using ->with() language chain', function() {
            it('should call function with array of args', function() {
                expect(function($x) {
                    if ($x == 1) {
                        throw new Exception("called with 1");
                    }
                })->with(1)->to->throw('Exception');
            });
        });

        context('when negated', function() {
            it('should throw an exception if exceptions are same', function() {
                expect(function() {
                    expect(function() {
                        throw new Exception("failure");
                    })->to->not->throw('Exception');
                })->to->throw('Exception');
            });
        });
    });
});
