<?php
describe('expect', function() {
    describe('to->equal()', function() {
        it('should match objects that are the same', function() {
            $obj = new stdClass;
            expect($obj)->to->equal($obj);
        });

        it('should throw an exception when objects are different', function() {
            $actual = new stdClass;
            $expected = new stdClass;
            $interface = expect($obj)->to;
            expect([$interface, 'equal'])->with($expected)->to->throw('Exception');
        });
    });

    describe('to->throw()', function() {
        it('should match when function throws exception', function() {
            expect(function() {
                throw new Exception("ooooops");
            })->to->throw('Exception');
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
    });
});
