<?php

use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Responder\Exception\AssertionException;
use Peridot\Leo\Responder\ExceptionResponder;
use Prophecy\Argument;

describe('ExceptionResponder', function () {
    beforeEach(function () {
        $this->formatter = $this->getProphet()->prophesize('Peridot\Leo\Formatter\FormatterInterface');
        $this->responder = new ExceptionResponder($this->formatter->reveal());
    });

    describe('->respond()', function () {
        beforeEach(function () {
            $this->formatter->getMessage(Argument::any())->willReturn('FAIL');
            $this->match = new Match(false, 4, 3, false);
            $this->template = new ArrayTemplate([
                'default' => 'Default',
                'negated' => 'Negated',
            ]);
        });

        afterEach(function () {
            $this->getProphet()->checkPredictions();
        });

        it('should respond to a false match by throwing an exception', function () {
            $this->formatter->setMatch($this->match)->shouldBeCalled();
            expect([$this->responder, 'respond'])->with($this->match, $this->template)
                ->to->throw('Peridot\Leo\Responder\Exception\AssertionException', 'FAIL');
        });

        it('should allow a user exception message', function () {
            $this->formatter->setMatch($this->match)->shouldBeCalled();
            expect([$this->responder, 'respond'])->with($this->match, $this->template, 'user')
                ->to->throw('Peridot\Leo\Responder\Exception\AssertionException', 'user');
        });

        it('should trim the exception stack trace', function () {
            $this->formatter->setMatch($this->match)->shouldBeCalled();
            $line = null;
            $exception = null;
            $trace = [];
            try {
                ($line = __LINE__) && $this->responder->respond($this->match, $this->template);
            } catch (AssertionException $exception) {
                $trace = $exception->getTrace();
            }
            expect($exception)->to->be->an->instanceof('Peridot\Leo\Responder\Exception\AssertionException');
            expect(count($trace))->to->equal(1);
            expect($trace[0]['file'])->to->equal(__FILE__);
            expect($trace[0]['line'])->to->equal($line);
        });

        it('should do nothing for a true match', function () {
            $match = new Match(true, 3, 3, false);
            $template = new ArrayTemplate(['default' => '', 'negated' => '']);
            $this->formatter->getMessage(Argument::any())->shouldNotBeCalled();
            $this->formatter->setMatch($match)->shouldNotBeCalled();
            $this->responder->respond($match, $template);
        });
    });
});
