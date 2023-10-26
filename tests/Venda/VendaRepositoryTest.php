<?php

namespace Jonaselias\ExpertFramework\Tests\Venda;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;
use Jonaselias\ExpertFramework\Model\Venda\VendaModel;
use Jonaselias\ExpertFramework\Repository\Venda\VendaRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class VendaRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInsertVenda()
    {
        $container = $this->createMockContainer();
        $vendaModel = $this->createMockVendaModel();
        $database = $this->createMockDatabase();

        $vendaModel->shouldReceive('create')->with(['dados' => 'dados'])->andReturnUsing(function () {
            $this->assertTrue(true);
            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Venda\VendaModel')
            ->andReturn($vendaModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new VendaRepository($container);
        $impostoRepository->insereVenda([
            'dados' => 'dados',
        ]);
    }

    public function testInsertGetIdVenda()
    {
        $container = $this->createMockContainer();
        $vendaModel = $this->createMockVendaModel();
        $database = $this->createMockDatabase();

        $vendaModel->shouldReceive('insertGetId')->with(['dados' => 'dados'])->andReturnUsing(function () {
            $this->assertTrue(true);
            return 1;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Venda\VendaModel')
            ->andReturn($vendaModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new VendaRepository($container);
        $impostoRepository->insereVendaGetId([
            'dados' => 'dados',
        ]);
    }

    private function createMockContainer(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ContainerInterface
    {
        return Mockery::mock(ContainerInterface::class);
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
