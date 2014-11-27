<?php
use Peridot\Leo\Matcher\EqualMatcher;
use Peridot\Leo\Matcher\Template\Template;

describe('EqualMatcher', function() {
    beforeEach(function() {
        $template = new Template(['default' => 'default', 'negated' => 'negated']);
        $this->matcher = new EqualMatcher($template);
    });

    describe('->match()', function() {
        it('should return true if both values are the same', function() {
            $expected = new stdClass();
            $actual = $expected;
            $isMatch = $this->matcher->match($expected, $actual);
            assert($isMatch, "should match same");
        });

        it('should return false if both values are different', function() {
            $expected = new stdClass();
            $actual = new stdClass();
            $isMatch = $this->matcher->match($expected, $actual);
            assert(!$isMatch, "should not match different");
        });

        context('when negated', function() {
            it('should return false if both values are the same', function() {
                $expected = $actual = new stdClass();
                $isMatch = $this->matcher->invert()->match($expected, $actual);
                assert(!$isMatch, "negated should not match same");
            });

            it('should return true if both values are different', function() {
                $expected = new stdClass();
                $actual = new stdClass();
                $isMatch = $this->matcher->invert()->match($expected, $actual);
                assert($isMatch, "negated should match different");
            });
        });
    });

    describe('->getTemplate()', function() {
        it("should return the matcher's template", function() {
            $template = $this->matcher->getTemplate();
            assert($template->getDefaultTemplate() == "default", "incorrect default template");
            assert($template->getNegatedTemplate() == "negated", "incorrected negated template");
        });
    });
});
