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

    describe('->a()', function() {
        it('should throw an exception for different types', function() {
            expect(function() {
                expect(new stdClass())->to->be->a('string');
            })->to->throw('Exception', 'Expected "string", got "object"');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(new stdClass())->to->be->a('string', "wrong type");
            })->to->throw('Exception', 'wrong type');
        });

        context('when negated', function() {
            it('should throw an exception if types are the same', function() {
                expect(function() {
                    expect(new stdClass())->to->not->be->a("object");
                })->to->throw('Exception', 'Expected a type other than "object"');
            });
        });
    });

    describe('->include()', function() {
        it('should throw an exception if value is not included', function() {
            expect(function() {
                expect('hello')->to->include('goodbye');
            })->to->throw('Exception', 'Expected "hello" to include "goodbye"');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect('hello')->to->include('goodbye', 'not included');
            })->to->throw('Exception', 'not included');
        });

        context('when negated', function() {
            it('should throw an exception if value is included', function() {
                expect(function() {
                    expect('hello')->to->not->include('hello');
                })->to->throw('Exception', 'Expected "hello" to not include "hello"');
            });
        });
    });

    describe('->ok', function() {
        it('should throw an exception if value is not truthy', function() {
            expect(function() {
                expect(false)->to->be->ok;
            })->to->throw('Exception', 'Expected false to be truthy');
        });

        context('when negated', function() {
            it('should throw an exception when value is truthy', function() {
                expect(function() {
                    expect(true)->to->not->be->ok;
                })->to->throw('Exception', 'Expected true to be falsy');
            });
        });

        context('when used as a method', function() {
            it('should throw an exception if value is not truthy', function() {
                expect(function() {
                    expect(false)->to->be->ok();
                })->to->throw('Exception', 'Expected false to be truthy');
            });

            it('should allow a user message', function() {
                expect(function() {
                    expect(false)->to->be->ok("not ok");
                })->to->throw('Exception', 'not ok');
            });
        });
    });

    describe('->true', function() {
        it('should throw an exception if value is not true', function() {
            expect(function() {
                expect('true')->to->be->true;
            })->to->throw('Exception', 'Expected "true" to be true');
        });

        context('when negated', function() {
            it('should throw an exception when value is true', function() {
                expect(function() {
                    expect(true)->to->not->be->true;
                })->to->throw('Exception', 'Expected true to be false');
            });
        });

        context('when used as a method', function() {
            it('should throw an exception if value is not true', function() {
                expect(function() {
                    expect(false)->to->be->true();
                })->to->throw('Exception', 'Expected false to be true');
            });

            it('should allow a user message', function() {
                expect(function() {
                    expect(false)->to->be->true("not true");
                })->to->throw('Exception', 'not true');
            });
        });
    });
});
