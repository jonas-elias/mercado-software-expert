<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Imposto;

use ExpertFramework\Container\Container;
use Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel;

/**
 * class ImpostoRepository
 *
 * @package Jonaselias\ExpertFramework\Repository
 * @author jonas-elias
 */
class ImpostoRepository
{
    /**
     * @var ImpostoModel $impostoModel
     */
    protected ImpostoModel $impostoModel;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->impostoModel = Container::get('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel');
    }

    /**
     * Method to insert imposto
     *
     * @param array $atributos
     * @return void
     */
    public function insereImposto(array $atributos): void
    {
        $this->impostoModel::create($atributos);
    }

    /**
     * Method to get imposto
     *
     * @return array
     */
    public function getImpostos(): array
    {
        return $this->impostoModel::table('imposto as i')
            ->join('tipo_produto as tp', 'i.id_tipo_produto', '=', 'tp.id')
            ->select(['i.valor', 'tp.nome'])
            ->where('i.data_exclusao', '=', '0001-01-01')
            ->get();
    }

    /**
     * Method to update imposto
     *
     * @param array $atributos
     * @param int $id
     * @return array
     */
    public function atualizaImposto(array $atributos, int $id): void
    {
        $this->impostoModel::update($atributos, $id);
    }

    /**
     * Method to get imposto by id
     *
     * @param int $id
     * @param array
     */
    public function getImpostoById(int $id): array
    {
        return $this->impostoModel::find($id);
    }

    /**
     * Method to delete imposto by id (soft delete)
     *
     * @param int $id
     * @return void
     */
    public function deletaImpostoById(int $id): void
    {
        $this->impostoModel::update(['data_exclusao' => date('Y-m-d H:i:s')], $id);
    }
}
