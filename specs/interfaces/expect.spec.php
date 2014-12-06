<?php
describe('expect', function() {
    describe('->equal()', function() {
        it('should match objects that are the same', function() {
            $obj = new stdClass;
            expect($obj)->to->equal($obj);
        });

        context('when using the "loosely" flag', function() {
            it('should match objects that are loosely equal', function() {
                expect(1)->to->loosely->equal("1");
            });
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

    describe('->false', function() {
        it('should throw an exception if value is not false', function() {
            expect(function() {
                expect(true)->to->be->false;
            })->to->throw('Exception', 'Expected true to be false');
        });

        context('when negated', function() {
            it('should throw an exception when value is false', function() {
                expect(function() {
                    expect(false)->to->not->be->false;
                })->to->throw('Exception', 'Expected false to be true');
            });
        });

        context('when used as a method', function() {
            it('should throw an exception if value is not false', function() {
                expect(function() {
                    expect(true)->to->be->false();
                })->to->throw('Exception', 'Expected true to be false');
            });

            it('should allow a user message', function() {
                expect(function() {
                    expect(true)->to->be->false("not false");
                })->to->throw('Exception', 'not false');
            });
        });
    });

    describe('->null', function() {
        it('should throw an exception if value is not null', function() {
            expect(function() {
                expect(true)->to->be->null;
            })->to->throw('Exception', 'Expected true to be null');
        });

        context('when negated', function() {
            it('should throw an exception when value is null', function() {
                expect(function() {
                    expect(null)->to->not->be->null;
                })->to->throw('Exception', 'Expected null not to be null');
            });
        });

        context('when used as a method', function() {
            it('should throw an exception if value is not null', function() {
                expect(function() {
                    expect(true)->to->be->null();
                })->to->throw('Exception', 'Expected true to be null');
            });

            it('should allow a user message', function() {
                expect(function() {
                    expect(true)->to->be->null("not null");
                })->to->throw('Exception', 'not null');
            });
        });
    });

    describe('->empty', function() {
        it('should throw an exception if value is not empty', function() {
            expect(function() {
                expect([1])->to->be->empty;
            })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to be empty");
        });

        context('when negated', function() {
            it('should throw an exception when value is empty', function() {
                expect(function() {
                    expect([])->to->not->be->empty;
                })->to->throw('Exception', "Expected Array\n(\n) not to be empty");
            });
        });

        context('when used as a method', function() {
            it('should throw an exception if value is not empty', function() {
                expect(function() {
                    expect("string")->to->be->empty();
                })->to->throw('Exception', 'Expected "string" to be empty');
            });

            it('should allow a user message', function() {
                expect(function() {
                    expect([1])->to->be->empty("not empty");
                })->to->throw('Exception', 'not empty');
            });
        });
    });

    describe('->above()', function() {
        it('should throw an exception if value is less than expected', function() {
            expect(function() {
                expect(5)->to->be->above(6);
            })->to->throw('Exception', 'Expected 5 to be above 6');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(5)->to->be->above(6, 'not above');
            })->to->throw('Exception', 'not above');
        });

        context('when negated', function() {
            it('should throw an exception if actual is above expected', function() {
                expect(function() {
                    expect(5)->to->not->be->above(4);
                })->to->throw('Exception', 'Expected 5 to be at most 4');
            });
        });

        context('when combined with the length flag', function() {
            it('should throw an exception if actual length is less than expected', function() {
                expect(function () {
                    expect([1])->to->have->length->above(2);
                })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a length above 2 but got 1");
            });
        });
    });
});
