<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Produto;

use ExpertFramework\Database\BaseModel;

class TipoProdutoModel extends BaseModel
{
    /**
     * @var string $table
     */
    protected static string $table = 'tipo_produto';

    /**
     * @var array $columns
     */
    protected static array $columns = ['*'];

    /**
     * @var array $conditionEqual
     */
    protected static array $conditionEqual = [
        'data_exclusao' => '0001-01-01'
    ];
}
