<?php
use Peridot\Leo\Interfaces\AbstractBaseInterface;

describe('AbstractBaseInterface', function() {
    beforeEach(function() {
        $this->interface = new TestInterface([]);
    });

    context('when a flag returns a non-object', function() {
        it('should return the scope', function() {
            $flag = $this->getProphet()->prophesize('Peridot\Leo\Flag\FlagInterface');
            $flag->getId()->willReturn('zoom');
            $flag->__invoke($this->interface)->willReturn(null);
            $this->interface->setFlag($flag->reveal());

            $scope = $this->interface->zoom;
            assert($scope === $this->interface, 'non object return from flag should return interface');
        });
    });

    describe('->getFlag()', function() {
        it('should return a flag by id', function() {
            $flag = $this->getProphet()->prophesize('Peridot\Leo\Flag\FlagInterface');
            $flag->getId()->willReturn('zoom');
            $obj = $flag->reveal();
            $this->interface->setFlag($obj);

            $fetched = $this->interface->getFlag('zoom');
            assert($fetched === $obj, "expected flag to be set and fetched");
        });

        it('should return null if flag by id does not exist', function() {
            assert(is_null($this->interface->getFlag('nope')), "expected flag to be null");
        });
    });
});

class TestInterface extends AbstractBaseInterface
{

}
