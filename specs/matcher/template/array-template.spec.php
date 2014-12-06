<?php
use Peridot\Leo\Matcher\Template\ArrayTemplate;

describe('ArrayTemplate', function() {
    beforeEach(function() {
        $this->template = new ArrayTemplate([
            'default' => 'default',
            'negated' => 'negated'
        ]);
    });

    describe('default template accessors', function() {
        it('should allow access to default template', function() {
            $tpl = "newdefault";
            $this->template->setDefaultTemplate($tpl);
            expect($this->template->getDefaultTemplate())->to->equal($tpl);
        });
    });

    describe('negated template accessors', function() {
        it('should allow access to negated template', function() {
            $tpl = "newnegated";
            $this->template->setNegatedTemplate($tpl);
            expect($this->template->getNegatedTemplate())->to->equal($tpl);
        });
    });
});
