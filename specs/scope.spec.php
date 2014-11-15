<?php
use Peridot\Leo\Scope;

describe('Scope', function() {
    beforeEach(function() {
        $this->scope = new Scope();
    });

    /**
     * Test scope's chainable properties
     */
    include 'shared/is-chainable-scope.php';

    context('when ->not is accessed', function() {
        it('should set the negated flag and return self', function() {
            $scope = $this->scope->not;
            assert($scope === $this->scope, "should return self");
            assert($scope->isNegated(), "scope should be negated");
        });
    });
});
