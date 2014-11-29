<?php
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

describe('ExceptionMatcher', function() {

    beforeEach(function() {
        $this->matcher = new ExceptionMatcher(function() {
            throw new DomainException("hello world");
        });
    });

    describe('->match()', function() {
        it('should return true result if callable throws exception', function() {
            $result = $this->matcher->match('DomainException');
            expect($result->isMatch())->to->equal(true);
        });

        it('should return false result if callable throws different type', function() {
            $result = $this->matcher->match('RuntimeException');
            expect($result->isMatch())->to->equal(false);
        });

        context('when inverted', function() {
            it('should return true result if exceptions are different', function() {
                $result = $this->matcher->invert()->match('RuntimeException');
                expect($result->isMatch())->to->equal(true);
            });

            it('should return false result if exceptions are same', function() {
                $result = $this->matcher->invert()->match('DomainException');
                expect($result->isMatch())->to->equal(false);
            });
        });

        context('when matching exception message', function() {
            it('should return true result if messages are the same', function() {
                $this->matcher->setExpectedMessage("hello world");
                $result = $this->matcher->match('Exception');
                expect($result->isMatch())->to->equal(true);
            });

            it('should return false result if messages are different', function() {
                $this->matcher->setExpectedMessage("goodbye");
                $result = $this->matcher->match('Exception');
                expect($result->isMatch())->to->equal(false);
            });

            context('and matcher is inverted', function() {
                it('should return true result if exception messages are different', function() {
                    $this->matcher->setExpectedMessage('goodbye');
                    $result = $this->matcher->invert()->match('DomainException');
                    expect($result->isMatch())->to->equal(true);
                });

                it('should return false result if exception messages are same', function() {
                    $this->matcher->setExpectedMessage('hello world');
                    $result = $this->matcher->invert()->match('DomainException');
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
        context('when message has been set', function() {
            beforeEach(function() {
                $this->matcher->setMessage('message');
            });

            it('should should return the set message template', function() {
                $template = new ArrayTemplate([]);
                $this->matcher->setMessageTemplate($template);
                expect($this->matcher->getTemplate())->to->equal($template);
            });
        });
    });
});
