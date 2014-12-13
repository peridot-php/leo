<?php
use Peridot\Leo\Matcher\KeysMatcher;

describe('KeysMatcher', function() {
    beforeEach(function() {
        $this->matcher = new KeysMatcher(['foo', 'bar']);
    });

    it('should return true if the array has all keys', function() {
        $result = $this->matcher->match(['foo' => 1, 'bar' => 2]);
        expect($result->isMatch())->to->be->true;
    });

    it('should return false if the array does not have has all keys', function() {
        $result = $this->matcher->match(['foo' => 1]);
        expect($result->isMatch())->to->be->false;
    });

    it('should return true if the object has all keys', function() {
        $obj = new stdClass();
        $obj->foo = 1;
        $obj->bar = 2;
        $result = $this->matcher->match($obj);
        expect($result->isMatch())->to->be->true;
    });

    it('should return flase if the object does not have all keys', function() {
        $obj = new stdClass();
        $obj->foo = 1;
        $result = $this->matcher->match($obj);
        expect($result->isMatch())->to->be->false;
    });

    it('should throw an exception if something other than an array or object is given', function() {
        expect([$this->matcher, 'match'])->with(1)->to->throw('InvalidArgumentException');
    });

    context('when inverted', function() {
        it('should return false if array does have all keys', function() {
            $result = $this->matcher->invert()->match(['foo' => 1, 'bar' => 2]);
            expect($result->isMatch())->to->be->false;
        });
    });
});
