<?php
describe('assertion subject', function () {
    it('should be accessible', function () {
        $this->interface->setSubject("hello");
        $subject = $this->interface->getSubject();
        assert($subject == "hello", "expected 'hello', got '$subject'");
    });
});
