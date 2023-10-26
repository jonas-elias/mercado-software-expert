<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Produto;

use ExpertFramework\Database\BaseModel;

/**
 * class ProdutoModel.
 *
 * @author jonas-elias
 */
class ProdutoModel extends BaseModel
{
    /**
     * @var string
     */
    protected static string $table = 'produto';

    /**
     * @var array
     */
    protected static array $columns = ['*'];
}
