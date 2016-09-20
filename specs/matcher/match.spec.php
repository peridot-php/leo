<?php

use Peridot\Leo\Matcher\Match;

describe('Match', function () {
    beforeEach(function () {
        $this->isMatch = false;
        $this->expected = 'expected';
        $this->actual = 'actual';
        $this->isNegated = false;
        $this->subject = new Match($this->isMatch, $this->expected, $this->actual, $this->isNegated);
    });

    it('should retain the data passed to the constructor', function () {
        expect($this->subject->isMatch())->to->equal($this->isMatch);
        expect($this->subject->getExpected())->to->equal($this->expected);
        expect($this->subject->getActual())->to->equal($this->actual);
        expect($this->subject->isNegated())->to->equal($this->isNegated);
    });

    it('should allow setting of the actual value', function () {
        $this->subject->setActual('other');

        expect($this->subject->getActual())->to->equal('other');
    });

    it('should allow setting of the expected value', function () {
        $this->subject->setExpected('other');

        expect($this->subject->getExpected())->to->equal('other');
    });
});
