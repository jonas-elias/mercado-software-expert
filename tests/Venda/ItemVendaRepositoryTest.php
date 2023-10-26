<?php

namespace Jonaselias\ExpertFramework\Tests\Venda;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;
use Jonaselias\ExpertFramework\Model\Venda\ItemVendaModel;
use Jonaselias\ExpertFramework\Model\Venda\VendaModel;
use Jonaselias\ExpertFramework\Repository\Venda\ItemVendaRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class ItemVendaRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInsertItemVenda()
    {
        $container = $this->createMockContainer();
        $itemVendaModel = $this->createMockItemVendaModel();
        $vendaModel = $this->createMockVendaModel();
        $database = $this->createMockDatabase();

        $data = [['dados' => 'dados']];

        $itemVendaModel->shouldReceive('create')->with($data[0])->andReturnUsing(function () {
            $this->assertTrue(true);
            return true;
        });

        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Venda\ItemVendaModel')
            ->andReturn($itemVendaModel);
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Venda\VendaModel')
            ->andReturn($vendaModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ItemVendaRepository($container);
        $impostoRepository->insereItemVenda($data);
    }

    private function createMockContainer(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ContainerInterface
    {
        return Mockery::mock(ContainerInterface::class);
    }

    private function createMockItemVendaModel(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ItemVendaModel
    {
        return Mockery::mock(ItemVendaModel::class);
    }

    private function createMockVendaModel(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|VendaModel
    {
        return Mockery::mock(VendaModel::class);
    }

    private function createMockDatabase(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|Database
    {
        return Mockery::mock(Database::class);
    }
}
