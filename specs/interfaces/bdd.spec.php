<?php
use Peridot\Leo\Interfaces\Bdd;

describe('Bdd', function() {
    beforeEach(function() {
        $this->scope = new Bdd();
    });

    /**
     * Test scope's chainable properties
     */
    include __DIR__ . '/../shared/is-chainable-scope.php';

    context('when ->not is accessed', function() {
        it('should set the negated flag and return self', function() {
            $scope = $this->scope->not;
            assert($scope === $this->scope, "should return self");
            assert($scope->isNegated(), "scope should be negated");
        });
    });

    context('when a flag returns non object', function() {
        it('should return the scope', function() {
            $flag = $this->getProphet()->prophesize('Peridot\Leo\Flag\FlagInterface');
            $flag->getId()->willReturn('zoom');
            $flag->__invoke($this->scope)->willReturn(null);
            $this->scope->setFlag($flag->reveal());

            $scope = $this->scope->zoom;
            assert($scope === $this->scope, 'non object return from flag should return scope');
        });
    });
});
