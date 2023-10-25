<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Venda;

use ExpertFramework\Database\BaseModel;

/**
 * class VendaModel
 *
 * @package Jonaselias\ExpertFramework\Model\Venda
 * @author jonas-elias
 */
class VendaModel extends BaseModel
{
    /**
     * @var string $table
     */
    protected static string $table = 'venda';

    /**
     * @var array $columns
     */
    protected static array $columns = ['*'];
}
