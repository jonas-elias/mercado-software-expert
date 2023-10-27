<?php

namespace Jonaselias\ExpertFramework\Tests\Imposto;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;
use ExpertFramework\Database\Query\QueryBuilder;
use Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel;
use Jonaselias\ExpertFramework\Repository\Imposto\ImpostoRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class ImpostoRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInsertImposto()
    {
        $container = $this->createMockContainer();
        $impostoModel = $this->createMockImpostoModel();
        $database = $this->createMockDatabase();

        $impostoModel->shouldReceive('create')->with(['dados' => 'dados'])->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel')
            ->andReturn($impostoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ImpostoRepository($container);
        $impostoRepository->insereImposto([
            'dados' => 'dados',
        ]);
    }

    public function testUpdateImposto()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $impostoModel = $this->createMockImpostoModel();
        $database = $this->createMockDatabase();

        $impostoModel->shouldReceive('update')->with(['dados' => 'dados'], $id)->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel')
            ->andReturn($impostoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ImpostoRepository($container);
        $impostoRepository->atualizaImposto(['dados' => 'dados'], $id);
    }

    public function testGetImpostos()
    {
        $container = $this->createMockContainer();
        $impostoModel = $this->createMockImpostoModel();
        $queryBuilder = $this->createMockQueryBuilder();
        $database = $this->createMockDatabase();

        $impostoModel->shouldReceive('table')->with('imposto as i')->andReturnUsing(function () use ($queryBuilder) {
            $this->assertTrue(true);

            return $queryBuilder;
        });
        $queryBuilder->shouldReceive('select')
            ->with(['i.id', 'i.valor', 'tp.nome'])->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('join')->with('tipo_produto as tp', 'i.id_tipo_produto', '=', 'tp.id')
            ->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('get')->andReturn([]);
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel')
            ->andReturn($impostoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ImpostoRepository($container);
        $impostoRepository->getImpostos();
    }

    public function testGetProdutoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $impostoModel = $this->createMockImpostoModel();
        $queryBuilder = $this->createMockQueryBuilder();
        $database = $this->createMockDatabase();

        $impostoModel->shouldReceive('find')->with($id)->andReturnUsing(function () {
            $this->assertTrue(true);

            return [];
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel')
            ->andReturn($impostoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ImpostoRepository($container);
        $impostoRepository->getImpostoById($id);
    }

    public function testDeleteImpostoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $impostoModel = $this->createMockImpostoModel();
        $database = $this->createMockDatabase();

        $impostoModel->shouldReceive('destroy')->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel')
            ->andReturn($impostoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $impostoRepository = new ImpostoRepository($container);
        $impostoRepository->deletaImpostoById($id);
    }

    private function createMockContainer(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ContainerInterface
    {
        return Mockery::mock(ContainerInterface::class);
    }

    private function createMockImpostoModel(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ImpostoModel
    {
        return Mockery::mock(ImpostoModel::class);
    }

    private function createMockQueryBuilder(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|QueryBuilder
    {
        return Mockery::mock(QueryBuilder::class);
    }

    private function createMockDatabase(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|Database
    {
        return Mockery::mock(Database::class);
    }
}
