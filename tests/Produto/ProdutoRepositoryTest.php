<?php

namespace Jonaselias\ExpertFramework\Tests\Produto;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;
use ExpertFramework\Database\Query\QueryBuilder;
use Jonaselias\ExpertFramework\Model\Produto\ProdutoModel;
use Jonaselias\ExpertFramework\Repository\Produto\ProdutoRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProdutoRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInsertProduto()
    {
        $container = $this->createMockContainer();
        $produtoModel = $this->createMockProdutoModel();
        $database = $this->createMockDatabase();

        $produtoModel->shouldReceive('create')->with(['dados' => 'dados'])->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel')
            ->andReturn($produtoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $produtoRepository = new ProdutoRepository($container);
        $produtoRepository->insereProduto([
            'dados' => 'dados',
        ]);
    }

    public function testUpdateProduto()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $produtoModel = $this->createMockProdutoModel();
        $database = $this->createMockDatabase();

        $produtoModel->shouldReceive('update')->with(['dados' => 'dados'], $id)->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel')
            ->andReturn($produtoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $produtoRepository = new ProdutoRepository($container);
        $produtoRepository->atualizaProduto(['dados' => 'dados'], $id);
    }

    public function testGetProdutos()
    {
        $container = $this->createMockContainer();
        $produtoModel = $this->createMockProdutoModel();
        $queryBuilder = $this->createMockQueryBuilder();
        $database = $this->createMockDatabase();

        $produtoModel->shouldReceive('table')->with('produto as p')->andReturnUsing(function () use ($queryBuilder) {
            $this->assertTrue(true);

            return $queryBuilder;
        });
        $queryBuilder->shouldReceive('select')->with([
            'p.id',
            'p.nome',
            'p.descricao',
            'tp.id as id_tipo_produto',
            'p.preco',
        ])->andReturnUsing(function () use ($queryBuilder) {
            $this->assertTrue(true);

            return $queryBuilder;
        });
        $queryBuilder->shouldReceive('join')->with('tipo_produto as tp', 'p.id_tipo_produto', '=', 'tp.id')
            ->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('get')->andReturn([]);
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel')
            ->andReturn($produtoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $produtoRepository = new ProdutoRepository($container);
        $produtoRepository->getProdutos();
    }

    public function testGetProdutoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $produtoModel = $this->createMockProdutoModel();
        $queryBuilder = $this->createMockQueryBuilder();
        $database = $this->createMockDatabase();

        $produtoModel->shouldReceive('table')->with('produto as p')->andReturnUsing(function () use ($queryBuilder) {
            $this->assertTrue(true);

            return $queryBuilder;
        });
        $queryBuilder->shouldReceive('select')->with([
            'p.id',
            'p.preco',
            'i.valor as imposto_porcentagem',
            '((i.valor / 100) * p.preco) as valor_imposto',
            '(((i.valor / 100) * p.preco) + p.preco) as total',
            'p.id_tipo_produto',
            'p.nome',
            'p.descricao',
        ])->andReturnUsing(function () use ($queryBuilder) {
            $this->assertTrue(true);

            return $queryBuilder;
        });
        $queryBuilder->shouldReceive('join')->with('tipo_produto as tp', 'p.id_tipo_produto', '=', 'tp.id')
            ->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('join')->with('imposto as i', 'tp.id', '=', 'i.id_tipo_produto', 'LEFT JOIN')
            ->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('where')->with('p.id', '=', $id)
            ->andReturnUsing(function () use ($queryBuilder) {
                $this->assertTrue(true);

                return $queryBuilder;
            });
        $queryBuilder->shouldReceive('get')->andReturn([]);
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel')
            ->andReturn($produtoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $produtoRepository = new ProdutoRepository($container);
        $produtoRepository->getProdutoById($id);
    }

    public function testDeletaProdutoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $produtoModel = $this->createMockProdutoModel();
        $database = $this->createMockDatabase();

        $produtoModel->shouldReceive('destroy')->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel')
            ->andReturn($produtoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $produtoRepository = new ProdutoRepository($container);
        $produtoRepository->deletaProdutoById($id);
    }

    private function createMockContainer(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ContainerInterface
    {
        return Mockery::mock(ContainerInterface::class);
    }

    private function createMockProdutoModel(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ProdutoModel
    {
        return Mockery::mock(ProdutoModel::class);
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
