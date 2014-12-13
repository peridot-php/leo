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

    describe('->least()', function() {
        it('should throw an exception if value is less than expected', function() {
            expect(function() {
                expect(5)->to->be->at->least(6);
            })->to->throw('Exception', 'Expected 5 to be at least 6');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(5)->to->be->at->least(6, 'not at least');
            })->to->throw('Exception', 'not at least');
        });

        context('when negated', function() {
            it('should throw an exception if actual is at least expected', function() {
                expect(function() {
                    expect(5)->to->not->be->at->least(5);
                })->to->throw('Exception', 'Expected 5 to be below 5');
            });
        });

        context('when combined with the length flag', function() {
            it('should throw an exception if actual length is less than expected', function() {
                expect(function () {
                    expect([1])->to->have->length->at->least(2);
                })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a length at least 2 but got 1");
            });
        });
    });

    describe('->below()', function() {
        it('should throw an exception if value is more than expected', function() {
            expect(function() {
                expect(6)->to->be->below(5);
            })->to->throw('Exception', 'Expected 6 to be below 5');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(6)->to->be->below(5, 'not below');
            })->to->throw('Exception', 'not below');
        });

        context('when negated', function() {
            it('should throw an exception if actual is below expected', function() {
                expect(function() {
                    expect(4)->to->not->be->below(5);
                })->to->throw('Exception', 'Expected 4 to be at least 5');
            });
        });

        context('when combined with the length flag', function() {
            it('should throw an exception if actual length is more than expected', function() {
                expect(function () {
                    expect([1])->to->have->length->below(0);
                })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a length below 0 but got 1");
            });
        });
    });

    describe('->most()', function() {
        it('should throw an exception if value is more than expected', function() {
            expect(function() {
                expect(5)->to->be->at->most(4);
            })->to->throw('Exception', 'Expected 5 to be at most 4');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(5)->to->be->at->most(4, 'not at most');
            })->to->throw('Exception', 'not at most');
        });

        context('when negated', function() {
            it('should throw an exception if actual is at most expected', function() {
                expect(function() {
                    expect(4)->to->not->be->at->most(5);
                })->to->throw('Exception', 'Expected 4 to be above 5');
            });
        });

        context('when combined with the length flag', function() {
            it('should throw an exception if actual length is less than expected', function() {
                expect(function () {
                    expect([1])->to->have->length->at->most(0);
                })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a length at most 0 but got 1");
            });
        });
    });

    describe('->within()', function() {
        it('should throw an exception if value is not within range', function() {
            expect(function() {
                expect(5)->to->be->within(6,7);
            })->to->throw('Exception', 'Expected 5 to be within 6..7');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(5)->to->be->within(6,7, 'not within');
            })->to->throw('Exception', 'not within');
        });

        context('when negated', function() {
            it('should throw an exception if value is within lower and upper bounds', function() {
                expect(function() {
                    expect(5)->to->not->be->within(3, 6);
                })->to->throw('Exception', 'Expected 5 to not be within 3..6');
            });
        });

        context('when combined with the length flag', function() {
            it('should throw an exception if actual length is not within lower and upper bounds', function() {
                expect(function () {
                    expect([1])->to->have->length->within(2,3);
                })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to be within 2..3");
            });
        });
    });

    describe('->instanceof()', function() {
        it('should throw an exception if value is not instanceof expected', function() {
            expect(function() {
                expect([])->to->be->an->instanceof('stdClass');
            })->to->throw('Exception', "Expected Array\n(\n) to be instance of \"stdClass\"");
        });

        it('should allow a user message', function() {
            expect(function() {
                expect([])->to->be->an->instanceof('stdClass', 'wrong instance');
            })->to->throw('Exception', 'wrong instance');
        });

        context('when negated', function() {
            it('should throw an exception when the value is an instance of expected', function() {
                expect(function() {
                    expect(new stdClass())->to->not->be->an->instanceof('stdClass');
                })->to->throw('Exception', "Expected stdClass Object\n(\n) to not be an instance of \"stdClass\"");
            });
        });
    });

    describe('->property()', function() {
        it('should throw an exception if value does not have the property', function() {
           expect(function() {
               $std = new stdClass();
               expect($std)->to->have->property('name');
           })->to->throw('Exception', "Expected stdClass Object\n(\n) to have a property \"name\"");
        });

        it('should throw an exception if value does not match the property', function() {
            expect(function() {
                $values = [1];
                expect($values)->to->have->property(0, 3);
            })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a property 0 of 3, but got 1");
        });

        it('should throw an exception for missing property even if value is given', function() {
            expect(function() {
                $std = new stdClass();
                expect($std)->to->have->property('name', 'brian');
            })->to->throw('Exception', "Expected stdClass Object\n(\n) to have a property \"name\"");
        });

        it('should allow a user message', function() {
            expect(function() {
                $std = new stdClass();
                expect($std)->to->have->property('name', null, 'no property');
            })->to->throw('Exception', "no property");
        });

        it('should alter the subject for future chaining', function() {
           expect(function() {
               $object = new stdClass();
               $object->name = "brian";
               expect($object)->to->have->property('name')->with->length(4);
           })->to->throw('Exception', 'Expected "brian" to have a length of 4 but got 5');
        });

        context('when negated', function() {
            it('should throw an exception when value does have property', function() {
                expect(function() {
                    $std = new stdClass();
                    $std->name = "brian";
                    expect($std)->to->not->have->property('name');
                })->to->throw('Exception', "Expected stdClass Object\n(\n    [name] => brian\n) to not have a property \"name\"");
            });
        });

        context('when deep flag is enabled', function() {
            it('should throw an exception if value does not have the property', function() {
                $expectedMessage  = "Expected stdClass Object\n(\n";
                $expectedMessage .= "    [name] => stdClass Object\n";
                $expectedMessage .= "        (\n";
                $expectedMessage .= "            [first] => brian\n";
                $expectedMessage .= "        )\n\n";
                $expectedMessage .= ") to have a deep property \"name->last\"";
                expect(function() {
                    $std = new stdClass();
                    $std->name = new stdClass();
                    $std->name->first = 'brian';
                    expect($std)->to->have->deep->property('name->last');
                })->to->throw('Exception', $expectedMessage);
            });

            it('should throw an exception if value does not match the property', function() {
                $expectedMessage  = "Expected stdClass Object\n(\n";
                $expectedMessage .= "    [name] => stdClass Object\n";
                $expectedMessage .= "        (\n";
                $expectedMessage .= "            [first] => brian\n";
                $expectedMessage .= "        )\n\n";
                $expectedMessage .= ") to have a deep property \"name->first\" of \"steve\", but got \"brian\"";
                expect(function() {
                    $std = new stdClass();
                    $std->name = new stdClass();
                    $std->name->first = 'brian';
                    expect($std)->to->have->deep->property('name->first', 'steve');
                })->to->throw('Exception', $expectedMessage);
            });

            it('should throw an exception for missing property even if value is given', function() {
                $expectedMessage  = "Expected stdClass Object\n(\n";
                $expectedMessage .= "    [name] => stdClass Object\n";
                $expectedMessage .= "        (\n";
                $expectedMessage .= "            [first] => brian\n";
                $expectedMessage .= "        )\n\n";
                $expectedMessage .= ") to have a deep property \"name->last\"";
                expect(function() {
                    $std = new stdClass();
                    $std->name = new stdClass();
                    $std->name->first = 'brian';
                    expect($std)->to->have->deep->property('name->last', 'steve');
                })->to->throw('Exception', $expectedMessage);
            });

            it('should allow a user message', function() {
                expect(function() {
                    $std = new stdClass();
                    $std->name = new stdClass();
                    $std->name->first = 'brian';
                    expect($std)->to->have->deep->property('name->last', 'steve', 'no deep property');
                })->to->throw('Exception', "no deep property");
            });

            it('should alter the subject for future chaining', function() {
                expect(function() {
                    $std = new stdClass();
                    $std->name = new stdClass();
                    $std->name->first = 'brian';
                    expect($std)->to->have->deep->property('name->first')->with->length(4);
                })->to->throw('Exception', 'Expected "brian" to have a length of 4 but got 5');
            });

            context('and negated', function() {
                it('should throw an exception when value does have property', function() {
                    $expectedMessage  = "Expected stdClass Object\n(\n";
                    $expectedMessage .= "    [name] => stdClass Object\n";
                    $expectedMessage .= "        (\n";
                    $expectedMessage .= "            [first] => brian\n";
                    $expectedMessage .= "        )\n\n";
                    $expectedMessage .= ") to not have a deep property \"name->first\"";
                    expect(function() {
                        $std = new stdClass();
                        $std->name = new stdClass();
                        $std->name->first = "brian";
                        expect($std)->to->not->have->deep->property('name->first');
                    })->to->throw('Exception', $expectedMessage);
                });
            });
        });
    });

    describe('->length()', function() {
        it('should throw an exception if lengths do not match', function() {
            expect(function() {
                expect([1])->to->have->length(0);
            })->to->throw('Exception', "Expected Array\n(\n    [0] => 1\n) to have a length of 0 but got 1");
        });

        it('should allow a user message', function() {
            expect(function() {
                expect([1])->to->have->length(0, "wrong length");
            })->to->throw('Exception', "wrong length");
        });

        context('when negated', function () {
            it('should throw an exception when the length is the expected value', function() {
                expect(function() {
                    expect('hi')->to->not->have->length(2);
                })->to->throw('Exception', 'Expected "hi" to not have a length of 2');
            });
        });
    });

    describe('->match()', function() {
        it('should throw an exception if actual value does not match the expected pattern', function() {
            expect(function() {
                expect('hi')->to->match('/^bye/');
            })->to->throw('Exception', 'Expected "hi" to match "/^bye/"');
        });

        it('allow a user message', function() {
            expect(function() {
                expect('hi')->to->match('/^bye/', 'does not match');
            })->to->throw('Exception', 'does not match');
        });

        context('when negated', function() {
            it('should throw an exception if pattern does match', function() {
                expect(function() {
                    expect('hi')->to->not->match('/^hi/');
                })->to->throw('Exception', 'Expected "hi" not to match "/^hi/"');
            });
        });
    });

    describe('->string()', function() {
        it('should throw an exception if substring is not contained', function() {
            expect(function() {
                expect('foobar')->to->have->string('hi');
            })->to->throw('Exception', 'Expected "foobar" to contain "hi"');
        });

        it('should allow a user message', function() {
            expect(function() {
                expect('foobar')->to->have->string('hi', 'not in there');
            })->to->throw('Exception', 'not in there');
        });

        context('when negated', function() {
            it('should throw an exception if actual does contain expected', function() {
                expect(function() {
                    expect('foobar')->to->not->have->string('foo');
                })->to->throw('Exception', 'Expected "foobar" to not contain "foo"');
            });
        });
    });

    describe('->keys()', function() {
        it('should throw an exception if all keys not found', function() {
            expect(function() {
                expect(['foo' => 'bar'])->to->have->keys(['foo', 'baz']);
            })->to->throw('Exception', "Expected Array\n(\n    [foo] => bar\n) to have keys \"foo\", and \"baz\"");
        });

        it('should throw an exception if all keys not found in single key expectation', function() {
            expect(function() {
                expect(['foo' => 'bar'])->to->have->keys(['baz']);
            })->to->throw('Exception', "Expected Array\n(\n    [foo] => bar\n) to have key \"baz\"");
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(['foo' => 'bar'])->to->have->keys(['foo', 'baz'], "wrong keys");
            })->to->throw('Exception', "wrong keys");
        });

        context('when negated', function() {
            it('should throw an exception if key is found', function() {
                expect(function() {
                    expect(['foo' => 'bar'])->to->not->have->keys(['foo']);
                })->to->throw('Exception', "Expected Array\n(\n    [foo] => bar\n) to not have key \"foo\"");
            });
        });

        context('when contain flag is present', function() {
            it('should throw an exception if keys are not included', function() {
                expect(function() {
                    expect(['foo' => 'bar'])->to->contain->keys(['bar']);
                })->to->throw('Exception', "Expected Array\n(\n    [foo] => bar\n) to contain key \"bar\"");
            });
        });
    });

    describe('->satisfy()', function() {
        it('should throw an exception if actual value does not satisfy predicate', function() {
            expect(function() {
                expect(1)->to->satisfy('is_string');
            })->to->throw('Exception', "Expected 1 to satisfy \"is_string\"");
        });

        it('should allow a user message', function() {
            expect(function() {
                expect(1)->to->satisfy('is_string', "not a string");
            })->to->throw('Exception', "not a string");
        });

        context('when negated', function() {
            it('should throw an exception if actual value satisfies predicate', function() {
                expect(function() {
                    expect("hello")->not->to->satisfy('is_string');
                })->to->throw('Exception', "Expected \"hello\" to not satisfy \"is_string\"");
            });
        });
    });

    describe('compound matches', function() {
        it('should be able to perform two matches', function() {
            expect(function() {
                expect('hello')->to->have->length(5)->and->to->satisfy('is_numeric');
            })->to->throw('Exception', 'Expected "hello" to satisfy "is_numeric"');
        });
    });
});
