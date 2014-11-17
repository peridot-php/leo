<?php
use Peridot\Leo\Interfaces\AbstractBaseInterface;

describe('AbstractBaseInterface', function() {
    beforeEach(function() {
        $this->interface = new TestInterface([]);
    });

    context('when a flag returns non object', function() {
        it('should return the scope', function() {
            $flag = $this->getProphet()->prophesize('Peridot\Leo\Flag\FlagInterface');
            $flag->getId()->willReturn('zoom');
            $flag->__invoke($this->interface)->willReturn(null);
            $this->interface->setFlag($flag->reveal());

            $scope = $this->interface->zoom;
            assert($scope === $this->interface, 'non object return from flag should return interface');
        });
    });
});

class TestInterface extends AbstractBaseInterface
{

}
