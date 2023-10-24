<?php

namespace Jonaselias\ExpertFramework\Repository\Produto;

use ExpertFramework\Container\Container;
use Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel;

/**
 * class TipoProdutoRepository
 *
 * @package Jonaselias\ExpertFramework\Repository\Produto
 * @author jonas-elias
 */
class TipoProdutoRepository
{
    /**
     * @var TipoProdutoModel $tipoProdutoModel
     */
    protected TipoProdutoModel $tipoProdutoModel;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->tipoProdutoModel = Container::get('Jonaselias\ExpertFramework\Model\Produto\TipoProdutoModel');
    }

    /**
     * Method to insert type product
     *
     * @param array $atributos
     * @return void
     */
    public function insereTipoProduto(array $atributos): void
    {
        $this->tipoProdutoModel::create($atributos);
    }

    /**
     * Method to update type product
     *
     * @param array $atributos
     * @param int $id
     * @return void
     */
    public function atualizaTipoProduto(array $atributos, int $id): void
    {
        $this->tipoProdutoModel::update($atributos, $id);
    }

    /**
     * Method to get all types products
     *
     * @return array
     */
    public function getTiposProdutos(): array
    {
        return $this->tipoProdutoModel::all();
    }

    /**
     * Method to get type product by id
     *
     * @param int $id
     * @return array
     */
    public function getTipoProdutoById(int $id): array
    {
        return $this->tipoProdutoModel::find($id);
    }

    /**
     * Method to delete type product by id (soft delete)
     *
     * @param int $id
     * @return void
     */
    public function deletaTipoProdutoById(int $id): void
    {
        $this->tipoProdutoModel::update(['data_exclusao' => date('Y-m-d H:i:s')], $id);
    }
}
