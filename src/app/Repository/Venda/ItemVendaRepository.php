<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Repository\Venda;

use ExpertFramework\Container\Contract\ContainerInterface;
use Jonaselias\ExpertFramework\Model\Venda\ItemVendaModel;

/**
 * class ItemVendaRepository.
 *
 * @author jonas-elias
 */
class ItemVendaRepository extends VendaRepository
{
    /**
     * @var ItemVendaModel
     */
    protected ItemVendaModel $itemVendaModel;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct($this->container);
        $this->itemVendaModel = $this->container::get('Jonaselias\ExpertFramework\Model\Venda\ItemVendaModel');
    }

    /**
     * Method to insert venda.
     *
     * @param array $atributos
     *
     * @return void
     */
    public function insereItemVenda(array $atributos): void
    {
        foreach ($atributos as $itemVenda) {
            $this->itemVendaModel::create($itemVenda);
        }
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
