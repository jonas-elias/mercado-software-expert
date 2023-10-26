<?php

namespace Jonaselias\ExpertFramework\Tests\Produto;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Database\Database;
use Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel;
use Jonaselias\ExpertFramework\Repository\Produto\TipoProdutoRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class TipoProdutoRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInsertTipoProduto()
    {
        $container = $this->createMockContainer();
        $tipoProdutoModel = $this->createMockTipoProdutoModel();
        $database = $this->createMockDatabase();

        $tipoProdutoModel->shouldReceive('create')->with(['dados' => 'dados'])->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel')
            ->andReturn($tipoProdutoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $tipoProdutoRepository = new TipoProdutoRepository($container);
        $tipoProdutoRepository->insereTipoProduto([
            'dados' => 'dados',
        ]);
    }

    public function testUpdateTipoProduto()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $tipoProdutoModel = $this->createMockTipoProdutoModel();
        $database = $this->createMockDatabase();

        $tipoProdutoModel->shouldReceive('update')->with(['dados' => 'dados'], $id)->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel')
            ->andReturn($tipoProdutoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $tipoProdutoRepository = new TipoProdutoRepository($container);
        $tipoProdutoRepository->atualizaTipoProduto(['dados' => 'dados'], $id);
    }

    public function testGetTipoProdutos()
    {
        $container = $this->createMockContainer();
        $tipoProdutoModel = $this->createMockTipoProdutoModel();
        $database = $this->createMockDatabase();

        $tipoProdutoModel->shouldReceive('all')
            ->andReturnUsing(function () {
                $this->assertTrue(true);

                return [];
            });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel')
            ->andReturn($tipoProdutoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $tipoProdutoRepository = new TipoProdutoRepository($container);
        $tipoProdutoRepository->getTiposProdutos();
    }

    public function testGetTipoProdutoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $tipoProdutoModel = $this->createMockTipoProdutoModel();
        $database = $this->createMockDatabase();

        $tipoProdutoModel->shouldReceive('find')->with($id)->andReturnUsing(function () {
            $this->assertTrue(true);

            return [];
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel')
            ->andReturn($tipoProdutoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $tipoProdutoRepository = new TipoProdutoRepository($container);
        $tipoProdutoRepository->getTipoProdutoById($id);
    }

    public function testDeletaTipoProdutoById()
    {
        $id = rand(1, 100);

        $container = $this->createMockContainer();
        $tipoProdutoModel = $this->createMockTipoProdutoModel();
        $database = $this->createMockDatabase();

        $tipoProdutoModel->shouldReceive('destroy')->andReturnUsing(function () {
            $this->assertTrue(true);

            return true;
        });
        $container->shouldReceive('get')->with('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel')
            ->andReturn($tipoProdutoModel);
        $container->shouldReceive('get')->with('ExpertFramework\Database\Database')
            ->andReturn($database);

        $tipoProdutoRepository = new TipoProdutoRepository($container);
        $tipoProdutoRepository->deletaTipoProdutoById($id);
    }

    private function createMockContainer(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|ContainerInterface
    {
        return Mockery::mock(ContainerInterface::class);
    }

    private function createMockTipoProdutoModel(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|TipoProdutoModel
    {
        return Mockery::mock(TipoProdutoModel::class);
    }

    private function createMockDatabase(): \Mockery\MockInterface|\Mockery\LegacyMockInterface|Database
    {
        return Mockery::mock(Database::class);
    }
}
