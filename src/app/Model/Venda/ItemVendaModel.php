<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Venda;

use ExpertFramework\Database\BaseModel;

/**
 * class ItemVendaModel.
 *
 * @author jonas-elias
 */
class ItemVendaModel extends BaseModel
{
    /**
     * @var string
     */
    protected static string $table = 'itens_venda';

    /**
     * @var array
     */
    protected static array $columns = ['*'];
}
