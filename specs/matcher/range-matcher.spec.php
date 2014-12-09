<?php
use Peridot\Leo\Matcher\RangeMatcher;

describe('RangeMatcher', function() {
    beforeEach(function() {
        $this->matcher = new RangeMatcher(1,2);
    });

    describe('->setUpperBound()', function() {
        it('should throw an exception if non numeric value given', function() {
            expect([$this->matcher, 'setUpperBound'])
                ->with('string')->to->throw('InvalidArgumentException');
        });
    });

    describe('->setLowerBound()', function() {
        it('should throw an exception if non numeric value given', function() {
            expect([$this->matcher, 'setLowerBound'])
                ->with('string')->to->throw('InvalidArgumentException');
        });
    });

    describe('->getUpperBound()', function() {
        it('should fetch the upper bound', function() {
            $this->matcher->setUpperBound(5);
            expect($this->matcher->getUpperBound())->to->equal(5);
        });
    });

    describe('->getLowerBound()', function() {
        it('should fetch the lower bound', function() {
            $this->matcher->setLowerBound(5);
            expect($this->matcher->getLowerBound())->to->equal(5);
        });
    });

    describe('->match()', function() {
        it('should return true if value is within upper and lower bounds', function() {
            $result = $this->matcher
                ->setLowerBound(1)
                ->setUpperBound(3)
                ->match(2);
            expect($result->isMatch())->to->be->true;
        });

        context('when negated', function() {
            it('should return false if value is within upper and lower bounds', function() {
                $result = $this->matcher
                    ->invert()
                    ->setLowerBound(1)
                    ->setUpperBound(3)
                    ->match(2);
                expect($result->isMatch())->to->be->false;
            });
        });

        context('when matching the length of a countable', function() {
            it('should return true if value count is within upper and lower bounds', function() {
                $result = $this->matcher
                    ->setLowerBound(4)
                    ->setUpperBound(10)
                    ->setCountable('hello')
                    ->match();
                expect($result->isMatch())->to->be->true;
            });
        });
    });
});
