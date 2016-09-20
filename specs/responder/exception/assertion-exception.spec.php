<?php

use Peridot\Leo\Responder\Exception\AssertionException;

describe('AssertionException', function () {
    describe('::trim()', function () {
        it('handles traces without a Leo call', function () {
            $exception = new Exception();
            AssertionException::trim($exception);
            expect(count($exception->getTrace()))->to->equal(0);
        });
    });

    describe('::traceLeoCall()', function () {
        it('handles method call traces', function () {
            $trace = [
                [
                    'file' => '/path/to/file/a',
                    'line' => 111,
                    'function' => 'methodA',
                    'class' =>  'Peridot\Leo\ClassA',
                ],
                [
                    'file' => '/path/to/file/b',
                    'line' => 222,
                    'function' => 'methodB',
                    'class' =>  'Peridot\Leo\ClassB',
                ],
                [
                    'file' => '/path/to/file/c',
                    'line' => 333,
                    'function' => 'methodC',
                    'class' => 'ClassC',
                ],
            ];
            $expected = [
                'file' => '/path/to/file/b',
                'line' => 222,
                'function' => 'methodB',
                'class' =>  'Peridot\Leo\ClassB',
            ];

            expect(AssertionException::traceLeoCall($trace))->to->equal($expected);
        });

        it('handles function call traces', function () {
            $trace = [
                [
                    'file' => '/path/to/file/a',
                    'line' => 111,
                    'function' => 'methodA',
                    'class' =>  'Peridot\Leo\ClassA',
                ],
                [
                    'file' => '/path/to/file/b',
                    'line' => 222,
                    'function' => 'Peridot\Leo\functionB',
                ],
                [
                    'file' => '/path/to/file/c',
                    'line' => 333,
                    'function' => 'functionC',
                ],
            ];
            $expected = [
                'file' => '/path/to/file/b',
                'line' => 222,
                'function' => 'Peridot\Leo\functionB',
            ];

            expect(AssertionException::traceLeoCall($trace))->to->equal($expected);
        });

        it('handles traces with no external calls', function () {
            $trace = [
                [
                    'file' => '/path/to/file/a',
                    'line' => 111,
                    'function' => 'methodA',
                    'class' =>  'Peridot\Leo\ClassA',
                ],
                [
                    'file' => '/path/to/file/b',
                    'line' => 222,
                    'function' => 'Peridot\Leo\functionB',
                ],
            ];
            $expected = [
                'file' => '/path/to/file/b',
                'line' => 222,
                'function' => 'Peridot\Leo\functionB',
            ];

            expect(AssertionException::traceLeoCall($trace))->to->equal($expected);
        });

        it('handles empty traces', function () {
            expect(AssertionException::traceLeoCall([]))->to->equal(null);
        });
    });
});
