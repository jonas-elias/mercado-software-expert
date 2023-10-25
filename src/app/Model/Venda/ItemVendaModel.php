<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Venda;

use ExpertFramework\Database\BaseModel;

/**
 * class ItemVendaModel
 *
 * @package Jonaselias\ExpertFramework\Model\Venda
 * @author jonas-elias
 */
class ItemVendaModel extends BaseModel
{
    /**
     * @var string $table
     */
    protected static string $table = 'itens_venda';

    /**
     * @var array $columns
     */
    protected static array $columns = ['*'];
}
