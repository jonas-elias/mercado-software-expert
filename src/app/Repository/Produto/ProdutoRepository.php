<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Produto;

use ExpertFramework\Container\Container;
use Jonaselias\ExpertFramework\Model\Produto\ProdutoModel;

/**
 * class ProdutoRepository
 *
 * @package Jonaselias\ExpertFramework\Repository
 * @author jonas-elias
 */
class ProdutoRepository
{
    /**
     * @var ProdutoModel $produtoModel
     */
    protected ProdutoModel $produtoModel;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->produtoModel = Container::get('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel');
    }

    /**
     * Method to insert product
     *
     * @param array $atributos
     * @return void
     */
    public function insereProduto(array $atributos): void
    {
        $this->produtoModel::create($atributos);
    }

    /**
     * Method to get produtos
     *
     * @return array
     */
    public function getProdutos(): array
    {
        return $this->produtoModel::all();
    }

    /**
     * Method to update product
     *
     * @param array $atributos
     * @param int $id
     * @return array
     */
    public function atualizaProduto(array $atributos, int $id): void
    {
        $this->produtoModel::update($atributos, $id);
    }

    /**
     * Method to get produto by id
     *
     * @param int $id
     * @param array
     */
    public function getProdutoById(int $id): array
    {
        return $this->produtoModel::find($id);
    }

    /**
     * Method to delete product by id (soft delete)
     *
     * @param int $id
     * @return void
     */
    public function deletaProdutoById(int $id): void
    {
        $this->produtoModel::update(['data_exclusao' => date('Y-m-d H:i:s')], $id);
    }
}
