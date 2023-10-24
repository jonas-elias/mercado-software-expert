<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Imposto;

use ExpertFramework\Database\BaseModel;

/**
 * class ImpostoModel
 *
 * @package Jonaselias\ExpertFramework\Model
 * @author jonas-elias
 */
class ImpostoModel extends BaseModel
{
    /**
     * @var string $table
     */
    protected static string $table = 'imposto';

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
