<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Venda;

use ExpertFramework\Container\Contract\ContainerInterface;
use Jonaselias\ExpertFramework\Model\Venda\VendaModel;
use Jonaselias\ExpertFramework\Repository\Repository;

/**
 * class VendaRepository.
 *
 * @author jonas-elias
 */
class VendaRepository extends Repository
{
    /**
     * @var VendaModel
     */
    protected VendaModel $vendaModel;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct($this->container);
        $this->vendaModel = $this->container::get('Jonaselias\ExpertFramework\Model\Venda\VendaModel');
    }

    /**
     * Method to insert venda.
     *
     * @param array $atributos
     *
     * @return void
     */
    public function insereVenda(array $atributos): void
    {
        $this->vendaModel::create($atributos);
    }

    /**
     * Method to insert venda and get id.
     *
     * @param array $atributos
     *
     * @return int
     */
    public function insereVendaGetId(array $atributos): int
    {
        return $this->vendaModel::insertGetId($atributos);
    }

    /**
     * Method to get vendas.
     *
     * @return array
     */
    public function getVendas(): array
    {
        return $this->vendaModel::all();
    }
}
