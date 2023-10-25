<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Imposto;

use ExpertFramework\Container\Contract\ContainerInterface;
use Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel;
use Jonaselias\ExpertFramework\Repository\Repository;

/**
 * class ImpostoRepository.
 *
 * @author jonas-elias
 */
class ImpostoRepository extends Repository
{
    /**
     * @var ImpostoModel
     */
    protected ImpostoModel $impostoModel;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct($this->container);
        $this->impostoModel = $this->container::get('Jonaselias\ExpertFramework\Model\Imposto\ImpostoModel');
    }

    /**
     * Method to insert imposto.
     *
     * @param array $atributos
     *
     * @return void
     */
    public function insereImposto(array $atributos): void
    {
        $this->impostoModel::create($atributos);
    }

    /**
     * Method to get imposto.
     *
     * @return array
     */
    public function getImpostos(): array
    {
        return $this->impostoModel::table('imposto as i')
            ->join('tipo_produto as tp', 'i.id_tipo_produto', '=', 'tp.id')
            ->select(['i.id', 'i.valor', 'tp.nome'])
            ->get();
    }

    /**
     * Method to update imposto.
     *
     * @param array $atributos
     * @param int   $id
     *
     * @return array
     */
    public function atualizaImposto(array $atributos, int $id): void
    {
        $this->impostoModel::update($atributos, $id);
    }

    /**
     * Method to get imposto by id.
     *
     * @param int $id
     * @param array
     */
    public function getImpostoById(int $id): array
    {
        return $this->impostoModel::find($id);
    }

    /**
     * Method to delete imposto by id (soft delete).
     *
     * @param int $id
     *
     * @return void
     */
    public function deletaImpostoById(int $id): void
    {
        $this->impostoModel::destroy($id);
    }
}
