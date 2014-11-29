<?php
use Peridot\Leo\Matcher\AbstractMatcher;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

describe('Matcher', function() {

    beforeEach(function() {
        $this->matcher = new TestMatcher(true);
    });

    describe('->getTemplate()', function() {
        it('should return the default template if not set', function() {
            $template = new ArrayTemplate([]);
            $this->matcher->setDefaultTemplate($template);
            expect($this->matcher->getTemplate())->to->equal($template);
        });

        it('should return the template that was set if set', function() {
            $template = new ArrayTemplate([]);
            $this->matcher->setTemplate($template);
            expect($this->matcher->getTemplate())->to->equal($template);
        });
    });

    describe('->invert()', function() {
        it('should toggle negated status', function() {
            expect($this->matcher->isNegated())->to->equal(false);
            $this->matcher->invert();
            expect($this->matcher->isNegated())->to->equal(true);
        });
    });

});

class TestMatcher extends AbstractMatcher
{
    protected $testTemplate;

    public function setDefaultTemplate($template)
    {
        $this->testTemplate = $template;
    }

    public function getDefaultTemplate()
    {
        return $this->testTemplate;
    }

    protected function doMatch($actual)
    {
        return true;
    }
}
