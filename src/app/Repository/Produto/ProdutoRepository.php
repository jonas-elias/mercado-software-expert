<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Produto;

use ExpertFramework\Container\Contract\ContainerInterface;
use Jonaselias\ExpertFramework\Model\Produto\ProdutoModel;
use Jonaselias\ExpertFramework\Repository\Repository;
use Jonaselias\ExpertFramework\Trait\Produto\ProdutoTrait;

/**
 * class ProdutoRepository.
 *
 * @author jonas-elias
 */
class ProdutoRepository extends Repository
{
    use ProdutoTrait;

    /**
     * @var ProdutoModel
     */
    protected ProdutoModel $produtoModel;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct($this->container);
        $this->produtoModel = $this->container::get('Jonaselias\ExpertFramework\Model\Produto\ProdutoModel');
    }

    /**
     * Method to insert product.
     *
     * @param array $atributos
     *
     * @return void
     */
    public function insereProduto(array $atributos): void
    {
        $this->produtoModel::create($atributos);
    }

    /**
     * Method to get produtos.
     *
     * @return array
     */
    public function getProdutos(): array
    {
        return $this->produtoModel::table('produto as p')
            ->select(['p.id', 'p.nome', 'p.descricao', 'tp.id as id_tipo_produto', 'p.preco', 'p.data_exclusao'])
            ->join('tipo_produto as tp', 'p.id_tipo_produto', '=', 'tp.id')
            ->where('p.data_exclusao', '=', '0001-01-01')
            ->where('tp.data_exclusao', '=', '0001-01-01')
            ->get();
    }

    /**
     * Method to update product.
     *
     * @param array $atributos
     * @param int   $id
     *
     * @return array
     */
    public function atualizaProduto(array $atributos, int $id): void
    {
        $this->produtoModel::update($atributos, $id);
    }

    /**
     * Method to get produto by id.
     *
     * @param int $id
     * @param array
     */
    public function getProdutoById(int $id): array
    {
        $produto = $this->produtoModel::table('produto as p')
            ->select([
                'p.id',
                'p.preco',
                'i.valor as imposto_porcentagem',
                '((i.valor / 100) * p.preco) as valor_imposto',
                '(((i.valor / 100) * p.preco) + p.preco) as total',
                'p.id_tipo_produto',
                'p.nome',
                'p.descricao',
            ])
            ->join('tipo_produto as tp', 'p.id_tipo_produto', '=', 'tp.id')
            ->join('imposto as i', 'tp.id', '=', 'i.id_tipo_produto', 'LEFT JOIN')
            ->where('p.id', '=', $id)
            ->where('p.data_exclusao', '=', '0001-01-01')
            ->where('tp.data_exclusao', '=', '0001-01-01')
            ->get()[0] ?? [];

        return [$this->formatCasasDecimaisProduto($produto)];
    }

    /**
     * Method to delete product by id (soft delete).
     *
     * @param int $id
     *
     * @return void
     */
    public function deletaProdutoById(int $id): void
    {
        $this->produtoModel::update(['data_exclusao' => date('Y-m-d H:i:s')], $id);
    }
}
