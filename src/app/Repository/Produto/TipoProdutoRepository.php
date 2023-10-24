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

    }
}
