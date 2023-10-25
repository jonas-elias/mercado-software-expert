<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Venda;

use ExpertFramework\Database\BaseModel;

/**
 * class VendaModel.
 *
 * @author jonas-elias
 */
class VendaModel extends BaseModel
{
    /**
     * @var string
     */
    protected static string $table = 'venda';

    /**
     * @var array
     */
    protected static array $columns = ['*'];
}
