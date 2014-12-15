<?php
use Peridot\Leo\Interfaces\Assert;

describe('assert', function() {
    beforeEach(function() {
        $this->assert = new Assert();
    });

    it('should throw a BadMethodCallException when an unknown method is called', function() {
        $this->assert->throws(function() {
            $this->assert->nope();
        }, 'BadMethodCallException', 'Call to undefined method nope');
    });

    describe('->equal()', function() {
        it('should match to loosely equal values', function() {
            $this->assert->equal(3, '3');
        });

        it('should throw exception when values are not loosely equal', function() {
            $this->assert->throws(function() {
                $this->assert->equal(4, 3);
            }, 'Exception');
        });

        it('should throw exception with a user supplied message', function() {
            $this->assert->throws(function() {
                $this->assert->equal(4, 3, 'not equal');
            }, 'Exception', 'not equal');
        });

        it('should throw a formatted exception message', function() {
            $this->assert->throws(function() {
                $this->assert->equal(4, 3);
            }, 'Exception', 'Expected 3, got 4');
        });
    });

    describe('->notEqual()', function() {
        it('should throw when both values are same', function() {
            $this->assert->throws(function() {
                $this->assert->notEqual(4, 4);
            }, 'Exception');
        });

        it('should throw a user supplied message', function() {
            $this->assert->throws(function() {
                $this->assert->notEqual(4, 4, 'should not be equal');
            }, 'Exception', 'should not be equal');
        });
    });

    describe('->throws', function() {
        it('should match a function that throws an exception', function() {
            $this->assert->throws(function() {
                throw new Exception("error");
            }, 'Exception');
        });

        it('should allow a user supplied assertion message', function() {
            $this->assert->throws(function() {
                $this->assert->throws(function() {
                    throw new DomainException('oops');
                }, 'RuntimeException', "", "failure");
            }, 'Exception', 'failure');
        });
    });

    describe('->doesNotThrow()', function() {
        it('should throw an exception if function throws exception', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception("failure");
                }, 'Exception');
            }, 'Exception');
        });

        it('should throw an exception if equal messages are thrown', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception('failure');
                }, 'RuntimeException', 'failure');
            }, 'Exception');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->doesNotThrow(function() {
                    throw new Exception('failure');
                }, 'RuntimeException', 'failure', 'oooooops');
            }, 'Exception', 'oooooops');
        });
    });

    describe('->typeOf()', function() {
        it('should throw an exception if actual type and expected type are different', function() {
            $this->assert->throws(function() {
                $this->assert->typeOf(new stdClass(), "string");
            }, 'Exception', 'Expected "string", got "object"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->typeOf(new stdClass(), "string", 'wrong type');
            }, 'Exception', 'wrong type');
        });
    });

    describe('->notTypeOf()', function() {
        it('should throw an exception if actual type and expected type are same', function() {
            $this->assert->throws(function() {
                $this->assert->notTypeOf(new stdClass(), "object");
            }, 'Exception', 'Expected a type other than "object"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notTypeOf(new stdClass(), "object", "same type");
            }, 'Exception', 'same type');
        });
    });

    describe('->ok()', function() {
        it('should throw an exception if actual value is not truthy', function() {
            $this->assert->throws(function() {
                $this->assert->ok(false);
            }, 'Exception', 'Expected false to be truthy');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->ok(false, 'not ok');
            }, 'Exception', 'not ok');
        });
    });

    describe('->notOk()', function() {
        it('should throw an exception if actual value is truthy', function() {
            $this->assert->throws(function() {
                $this->assert->notOk(true);
            }, 'Exception', 'Expected true to be falsy');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notOk(true, 'is ok');
            }, 'Exception', 'is ok');
        });
    });

    describe('->strictEqual()', function() {
        it('should throw an exception if actual value is not identical to expected value', function() {
            $this->assert->throws(function() {
                $this->assert->strictEqual("string", "other");
            }, 'Exception', 'Expected "other" to be identical to "string"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->strictEqual("string", "other", "not identical");
            }, 'Exception', 'not identical');
        });
    });

    describe('->notStrictEqual()', function() {
        it('should throw an exception if actual value is identical to expected value', function() {
            $this->assert->throws(function() {
                $this->assert->notStrictEqual("string", "string");
            }, 'Exception', 'Expected "string" not to be identical to "string"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notStrictEqual("string", "string", "is identical");
            }, 'Exception', 'is identical');
        });
    });

    describe('->isTrue()', function() {
        it('should throw an exception if actual value is not true', function() {
            $this->assert->throws(function() {
                $this->assert->isTrue(false);
            }, 'Exception', 'Expected false to be true');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isTrue(false, "not true");
            }, 'Exception', 'not true');
        });
    });

    describe('->isFalse()', function() {
        it('should throw an exception if actual value is not false', function() {
            $this->assert->throws(function() {
                $this->assert->isFalse(true);
            }, 'Exception', 'Expected true to be false');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isFalse(true, "not false");
            }, 'Exception', 'not false');
        });
    });

    describe('->isNull()', function() {
        it('should throw an exception if actual value is not null', function() {
            $this->assert->throws(function() {
                $this->assert->isNull('str');
            }, 'Exception', 'Expected "str" to be null');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNull('str', 'not null');
            }, 'Exception', 'not null');
        });
    });

    describe('->isNotNull()', function() {
        it('should throw an exception if actual value is null', function() {
            $this->assert->throws(function() {
                $this->assert->isNotNull(null);
            }, 'Exception', 'Expected null not to be null');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotNull(null, 'is null');
            }, 'Exception', 'is null');
        });
    });

    describe('->isCallable()', function() {
        it('should throw an exception if actual value is not callable', function() {
            $this->assert->throws(function() {
                $this->assert->isCallable('ham');
            }, 'Exception', 'Expected "ham" to satisfy "is_callable"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isCallable('ham', 'not callable');
            }, 'Exception', 'not callable');
        });
    });

    describe('->isNotCallable()', function() {
        it('should throw an exception if actual value is callable', function() {
            $this->assert->throws(function() {
                $this->assert->isNotCallable('is_string');
            }, 'Exception', 'Expected "is_string" to not satisfy "is_callable"');
        });

        it('allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotCallable('is_string', 'is callable');
            }, 'Exception', 'is callable');
        });
    });

    describe('->isObject()', function() {
        it('should throw an exception if actual value is not an object', function() {
            $this->assert->throws(function() {
                $this->assert->isObject(null);
            }, 'Exception', 'Expected "object", got "NULL"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isObject(null, 'not an object');
            }, 'Exception', 'not an object');
        });
    });

    describe('->isNotObject()', function() {
        it('should throw an exception if actual value is an object', function() {
            $this->assert->throws(function() {
                $this->assert->isNotObject(new stdClass());
            }, 'Exception', 'Expected a type other than "object"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotObject(new stdClass(), 'an object');
            }, 'Exception', 'an object');
        });
    });

    describe('->isArray()', function() {
        it('should throw an exception if actual value is not an array', function() {
            $this->assert->throws(function() {
                $this->assert->isArray(null);
            }, 'Exception', 'Expected "array", got "NULL"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isArray(null, 'not an array');
            }, 'Exception', 'not an array');
        });
    });

    describe('->isNotArray()', function() {
        it('should throw an exception if actual value is an array', function() {
            $this->assert->throws(function() {
                $this->assert->isNotArray([]);
            }, 'Exception', 'Expected a type other than "array"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotArray([], 'an array');
            }, 'Exception', 'an array');
        });
    });

    describe('->isString()', function() {
        it('should throw an exception if actual value is not a string', function() {
            $this->assert->throws(function() {
                $this->assert->isString(5);
            }, 'Exception', 'Expected "string", got "integer"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isString(5, 'not a string');
            }, 'Exception', 'not a string');
        });
    });

    describe('->isNotString()', function() {
        it('should throw an exception if actual value is a string', function() {
            $this->assert->throws(function() {
                $this->assert->isNotString("hello");
            }, 'Exception', 'Expected a type other than "string"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotString('hello', 'a string');
            }, 'Exception', 'a string');
        });
    });

    describe('->isNumeric()', function() {
        it('should throw an exception if actual value is not numeric', function() {
            $this->assert->throws(function() {
                $this->assert->isNumeric('hello');
            }, 'Exception', 'Expected "hello" to satisfy "is_numeric"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNumeric('hello', 'not numeric');
            }, 'Exception', 'not numeric');
        });
    });

    describe('->isNotNumeric()', function() {
        it('should throw an exception if actual value is numeric', function() {
            $this->assert->throws(function() {
                $this->assert->isNotNumeric('5');
            }, 'Exception', 'Expected "5" to not satisfy "is_numeric"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotNumeric('5', 'numeric');
            }, 'Exception', 'numeric');
        });
    });

    describe('->isInteger()', function() {
        it('should throw an exception if actual value is not an integer', function() {
            $this->assert->throws(function() {
                $this->assert->isInteger(4.5);
            }, 'Exception', 'Expected "integer", got "double"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isInteger(4.5, 'not an integer');
            }, 'Exception', 'not an integer');
        });
    });

    describe('->isNotInteger()', function() {
        it('should throw an exception if actual value is an integer', function() {
            $this->assert->throws(function() {
                $this->assert->isNotInteger(4);
            }, 'Exception', 'Expected a type other than "integer"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotInteger(4, 'an integer');
            }, 'Exception', 'an integer');
        });
    });

    describe('->isDouble()', function() {
        it('should throw an exception if actual value is not a double', function() {
            $this->assert->throws(function() {
                $this->assert->isDouble(4);
            }, 'Exception', 'Expected "double", got "integer"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isDouble(4, 'not a double');
            }, 'Exception', 'not a double');
        });
    });

    describe('->isNotDouble()', function() {
        it('should throw an exception if actual value is a double', function() {
            $this->assert->throws(function() {
                $this->assert->isNotDouble(4.5);
            }, 'Exception', 'Expected a type other than "double"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotDouble(4.5, 'a double');
            }, 'Exception', 'a double');
        });
    });

    describe('->isResource()', function() {
        it('should throw an exception if actual value is not a resource', function() {
            $this->assert->throws(function() {
                $this->assert->isResource(null);
            }, 'Exception', 'Expected "resource", got "NULL"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isResource(null, 'not a resource');
            }, 'Exception', 'not a resource');
        });
    });

    describe('->isNotResource()', function() {
        it('should throw an exception if actual value is a resource', function() {
            $this->assert->throws(function() {
                $this->assert->isNotResource(tmpfile());
            }, 'Exception', 'Expected a type other than "resource"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotResource(tmpfile(), 'a resource');
            }, 'Exception', 'a resource');
        });
    });

    describe('->isBoolean()', function() {
        it('should throw an exception if actual value is not a boolean', function() {
            $this->assert->throws(function() {
                $this->assert->isBoolean(null);
            }, 'Exception', 'Expected "boolean", got "NULL"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isBoolean(null, 'not a boolean');
            }, 'Exception', 'not a boolean');
        });
    });

    describe('->isNotBoolean()', function() {
        it('should throw an exception if actual value is not a boolean', function() {
            $this->assert->throws(function() {
                $this->assert->isNotBoolean(true);
            }, 'Exception', 'Expected a type other than "boolean"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->isNotBoolean(true, 'a boolean');
            }, 'Exception', 'a boolean');
        });
    });

    describe('->instanceOf()', function() {
        it('should throw an exception if actual value is not the expected instance', function() {
            $this->assert->throws(function() {
                $this->assert->instanceOf('string', 'stdClass');
            }, 'Exception', 'Expected "string" to be instance of "stdClass"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->instanceOf('string', 'stdClass', 'wrong instance');
            }, 'Exception', 'wrong instance');
        });
    });

    describe('->notInstanceOf()', function() {
        it('should throw an exception if actual value is the expected instance', function() {
            $this->assert->throws(function() {
                $this->assert->notInstanceOf(new stdClass(), 'stdClass');
            }, 'Exception', "Expected stdClass Object\n(\n) to not be an instance of \"stdClass\"");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notInstanceOf(new stdClass(), 'stdClass', 'correct instance');
            }, 'Exception', 'correct instance');
        });
    });

    describe('->include()', function() {
        it('should throw an exception if needle is not in haystack', function() {
            $this->assert->throws(function() {
                $this->assert->include([1, 2], 3);
            }, 'Exception', "Expected Array\n(\n    [0] => 1\n    [1] => 2\n) to include 3");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->include([1, 2], 3, "not included");
            }, 'Exception', 'not included');
        });
    });

    describe('->notInclude()', function() {
        it('should throw an exception if needle is in haystack', function() {
            $this->assert->throws(function() {
                $this->assert->notInclude([1, 2], 2);
            }, 'Exception', "Expected Array\n(\n    [0] => 1\n    [1] => 2\n) to not include 2");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notInclude([1, 2], 2, 'included');
            }, 'Exception', "included");
        });
    });

    describe('->match()', function() {
        it('should throw an exception if actual value does not match pattern', function() {
            $this->assert->throws(function() {
                $this->assert->match("hello", '/^bye/');
            }, 'Exception', 'Expected "hello" to match "/^bye/"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->match("hello", '/^bye/', 'no match');
            }, 'Exception', 'no match');
        });
    });

    describe('->notMatch()', function() {
        it('should throw an exception if actual value does match pattern', function() {
            $this->assert->throws(function() {
                $this->assert->notMatch("hello", '/^he/');
            }, 'Exception', 'Expected "hello" not to match "/^he/"');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notMatch("hello", '/^he/', 'a match');
            }, 'Exception', 'a match');
        });
    });

    describe('->property()', function() {
        it('should throw an exception if actual does not have property', function() {
            $this->assert->throws(function() {
                $this->assert->property(['name' => 'brian'], 'profession');
            }, 'Exception', "Expected Array\n(\n    [name] => brian\n) to have a property \"profession\"");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->property(['name' => 'brian'], 'profession', 'no property');
            }, 'Exception', "no property");
        });
    });

    describe('->notProperty()', function() {
        it('should throw an exception if actual does have property', function() {
            $this->assert->throws(function() {
                $this->assert->notProperty(['name' => 'brian'], 'name');
            }, 'Exception', "Expected Array\n(\n    [name] => brian\n) to not have a property \"name\"");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->notProperty(['name' => 'brian'], 'name', 'has property');
            }, 'Exception', "has property");
        });
    });

    describe('->deepProperty()', function() {
        it('should throw an exception if actual does not have deep property', function() {
            $expected  = "Expected stdClass Object\n(\n";
            $expected .= "    [name] => stdClass Object\n        (\n";
            $expected .= "            [first] => brian\n        )\n\n";
            $expected .= ") to have a deep property \"name->last\"";

            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepProperty($obj, 'name->last');

            }, 'Exception', $expected);
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepProperty($obj, 'name->last', 'no deep property');

            }, 'Exception', "no deep property");
        });
    });

    describe('->notDeepProperty()', function() {
        it('should throw an exception if actual does have deep property', function() {
            $expected  = "Expected stdClass Object\n(\n";
            $expected .= "    [name] => stdClass Object\n        (\n";
            $expected .= "            [first] => brian\n        )\n\n";
            $expected .= ") to not have a deep property \"name->first\"";

            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->notDeepProperty($obj, 'name->first');

            }, 'Exception', $expected);
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->notDeepProperty($obj, 'name->first', 'deep property');

            }, 'Exception', "deep property");
        });
    });

    describe('->propertyVal()', function() {
        it('should throw an exception if actual does not have property value', function() {
            $this->assert->throws(function() {
                $this->assert->propertyVal(['name' => 'brian'], 'name', 'jennie');
            }, 'Exception', "Expected Array\n(\n    [name] => brian\n) to have a property \"name\" of \"jennie\", but got \"brian\"");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->propertyVal(['name' => 'brian'], 'name', 'jennie', 'wrong value');
            }, 'Exception', "wrong value");
        });
    });

    describe('->propertyNotVal()', function() {
        it('should throw an exception if actual does have property value', function() {
            $this->assert->throws(function() {
                $this->assert->propertyNotVal(['name' => 'brian'], 'name', 'brian');
            }, 'Exception', "Expected Array\n(\n    [name] => brian\n) to not have a property \"name\" of \"brian\"");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->propertyNotVal(['name' => 'brian'], 'name', 'brian', 'right value');
            }, 'Exception', "right value");
        });
    });

    describe('->deepPropertyVal()', function() {
        it('should throw an exception if actual does not have deep property value', function() {
            $expected  = "Expected stdClass Object\n(\n";
            $expected .= "    [name] => stdClass Object\n        (\n";
            $expected .= "            [first] => brian\n        )\n\n";
            $expected .= ") to have a deep property \"name->first\" of \"jennie\", but got \"brian\"";

            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepPropertyVal($obj, 'name->first', 'jennie');

            }, 'Exception', $expected);
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepPropertyVal($obj, 'name->first', 'jennie', 'wrong val');

            }, 'Exception', "wrong val");
        });
    });

    describe('->deepPropertyNotVal()', function() {
        it('should throw an exception if actual does have deep property value', function() {
            $expected  = "Expected stdClass Object\n(\n";
            $expected .= "    [name] => stdClass Object\n        (\n";
            $expected .= "            [first] => brian\n        )\n\n";
            $expected .= ") to not have a deep property \"name->first\" of \"brian\"";

            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepPropertyNotVal($obj, 'name->first', 'brian');

            }, 'Exception', $expected);
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $obj = new stdClass();
                $obj->name = new stdClass();
                $obj->name->first = 'brian';
                $this->assert->deepPropertyNotVal($obj, 'name->first', 'brian', 'right val');

            }, 'Exception', "right val");
        });
    });

    describe('->lengthOf()', function() {
        it('should throw an exception if countable does not have expected length', function() {
            $this->assert->throws(function() {
                $this->assert->lengthOf([1], 2);
            }, 'Exception', "Expected Array\n(\n    [0] => 1\n) to have a length of 2 but got 1");
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->lengthOf([1], 2, 'wrong length');
            }, 'Exception', "wrong length");
        });
    });

    describe('->operator()', function() {
        it('should throw an exception if an invalid operator is given', function() {
            $this->assert->throws(function() {
                $this->assert->operator(1, 'BOOOM', 2);
            }, 'InvalidArgumentException', 'Invalid operator BOOOM');
        });

        it('should dynamically call the assertion identified by the operator', function() {
            $this->assert->throws(function() {
                $this->assert->operator(1, '>', 2);
            }, 'Exception', 'Expected 1 to be above 2');
        });

        it('should allow a user message', function() {
            $this->assert->throws(function() {
                $this->assert->operator(3, '<', 2, 'too much');
            }, 'Exception', 'too much');
        });
    });
});
