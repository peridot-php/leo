<?php
use Peridot\Leo\Matcher\Match;
use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Responder\ExceptionResponder;
use Prophecy\Argument;

describe('ExceptionResponder', function() {
    beforeEach(function() {
        $this->formatter = $this->getProphet()->prophesize('Peridot\Leo\Formatter\FormatterInterface');
        $this->formatter->getMessage(Argument::any())->willReturn('FAIL');
        $this->responder = new ExceptionResponder($this->formatter->reveal());
    });

    describe('->respond()', function() {
        it('should respond to a false match by throwing an exception', function() {
            $match = new Match(false, 4, 3, false);
            $template = new ArrayTemplate([
                'default' => 'Default',
                'negated' => 'Negated'
            ]);
            $this->formatter->setMatch($match)->shouldBeCalled();
            expect([$this->responder, 'respond'])->with($match, $template)->to->throw('Exception', 'FAIL');
        });
    });
});
