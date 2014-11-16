<?php
describe('->to', function() {
    it('should return self', function() {
        assert($this->interface->to === $this->interface, "->to should return self");
    });
});

describe('->be', function() {
    it('should return self', function() {
        assert($this->interface->be === $this->interface, "->be should return self");
    });
});

describe('->been', function() {
    it('should return self', function() {
        assert($this->interface->been === $this->interface, "->been should return self");
    });
});

describe('->is', function() {
    it('should return self', function() {
        assert($this->interface->is === $this->interface, "->is should return self");
    });
});

describe('->that', function() {
    it('should return self', function() {
        assert($this->interface->that === $this->interface, "->that should return self");
    });
});

describe('->and', function() {
    it('should return self', function() {
        assert($this->interface->and === $this->interface, "->and should return self");
    });
});

describe('->has', function() {
    it('should return self', function() {
        assert($this->interface->has === $this->interface, "->has should return self");
    });
});

describe('->have', function() {
    it('should return self', function() {
        assert($this->interface->have === $this->interface, "->have should return self");
    });
});

describe('->with', function() {
    it('should return self', function() {
        assert($this->interface->with === $this->interface, "->with should return self");
    });
});

describe('->at', function() {
    it('should return self', function() {
        assert($this->interface->at === $this->interface, "->at should return self");
    });
});

describe('->of', function() {
    it('should return self', function() {
        assert($this->interface->of === $this->interface, "->of should return self");
    });
});

describe('->same', function() {
    it('should return self', function() {
        assert($this->interface->same === $this->interface, "->same should return self");
    });
});

describe('assertion subject', function () {
    it('should be accessible', function () {
        $this->interface->setSubject("hello");
        $subject = $this->interface->getSubject();
        assert($subject == "hello", "expected 'hello', got '$subject'");
    });
});
