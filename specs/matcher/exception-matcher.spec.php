<?php
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

describe('ExceptionMatcher', function() {

    beforeEach(function() {
        $this->matcher = new ExceptionMatcher('DomainException');
    });

    describe('->match()', function() {
        it('should return true result if callable throws exception', function() {
            $result = $this->matcher->match(function() {
                throw new DomainException('hello world');
            });
            expect($result->isMatch())->to->equal(true);
        });

        it('should return false result if callable throws different type', function() {
            $result = $this->matcher->match(function() {
                throw new RuntimeException('hello world');
            });
            expect($result->isMatch())->to->equal(false);
        });

        it('should throw exception if callable is not valid', function() {
            $obj = new stdClass();
            $matcher = new ExceptionMatcher('DomainException');
            expect([$matcher, 'match'])->with([$obj, 'nope'])->to->throw('BadFunctionCallException');
        });

        it('should return false when function throws no exception', function() {
            $matcher = new ExceptionMatcher('Exception');
            $result = $matcher->match(function() {});
            expect($result->isMatch())->to->equal(false);
        });

        context('when inverted', function() {
            it('should return true result if exceptions are different', function() {
                $result = $this->matcher->invert()->match(function() {
                    throw new RuntimeException();
                });
                expect($result->isMatch())->to->equal(true);
            });

            it('should return false result if exceptions are same', function() {
                $result = $this->matcher->invert()->match(function() {
                    throw new DomainException();
                });
                expect($result->isMatch())->to->equal(false);
            });
        });

        context('when matching exception message', function() {
            it('should return true result if messages are the same', function() {
                $this->matcher->setExpectedMessage("hello world");
                $result = $this->matcher->match(function() {
                    throw new DomainException('hello world');
                });
                expect($result->isMatch())->to->equal(true);
            });

            it('should return false result if messages are different', function() {
                $this->matcher->setExpectedMessage("goodbye");
                $result = $this->matcher->match(function() {
                    throw new DomainException('hello world');
                });
                expect($result->isMatch())->to->equal(false);
            });

            context('and matcher is inverted', function() {
                it('should return true result if exception messages are different', function() {
                    $this->matcher->setExpectedMessage('goodbye');
                    $result = $this->matcher->invert()->match(function() {
                        throw new DomainException('hello world');
                    });
                    expect($result->isMatch())->to->equal(true);
                });

                it('should return false result if exception messages are same', function() {
                    $this->matcher->setExpectedMessage('hello world');
                    $result = $this->matcher->invert()->match(function() {
                        throw new DomainException('hello world');
                    });
                    expect($result->isMatch())->to->equal(false);
                });
            });
        });
    });

    describe('->getDefaultMessageTemplate()', function() {
        it('should it return a template for wrong exception type by default', function() {
            $template = $this->matcher->getDefaultMessageTemplate();
            $default = $template->getDefaultTemplate();
            $negated = $template->getNegatedTemplate();
            expect($default)->to->equal('Expected exception message {{expected}}, got {{actual}}');
            expect($negated)->to->equal('Expected exception message {{expected}} not to equal {{actual}}');
        });
    });

    describe('->getTemplate()', function() {
        context('when expected message has been set', function() {
            beforeEach(function() {
                $this->matcher->setExpectedMessage('message');
            });

            it('should return the set message template', function() {
                $template = new ArrayTemplate([]);
                $this->matcher->setMessageTemplate($template);
                expect($this->matcher->getTemplate())->to->equal($template);
            });
        });
    });

    describe('->getArguments()', function() {
        it('should fetch callable arguments', function() {
            $args = [1,2,3];
            $this->matcher->setArguments($args);
            expect($this->matcher->getArguments())->to->equal($args);
        });
    });

    describe('->getExpectedMessage()', function() {
        it('should fetch expected message', function() {
            $expected = "expected";
            $this->matcher->setExpectedMessage($expected);
            expect($this->matcher->getExpectedMessage())->to->equal($expected);
        });
    });

    describe('->getMessage()', function() {
        it('should fetch the actual message', function() {
            $expected = "expected";
            $this->matcher->setMessage($expected);
            expect($this->matcher->getMessage())->to->equal($expected);
        });
    });
});
