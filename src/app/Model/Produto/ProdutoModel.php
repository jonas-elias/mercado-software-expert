<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Produto;
use ExpertFramework\Database\BaseModel;

/**
 * class ProdutoModel
 *
 * @package Jonaselias\ExpertFramework\Model
 * @author jonas-elias
 */
class ProdutoModel extends BaseModel
{
    /**
     * @var string $produto
     */
    protected static string $table = 'produto';

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
