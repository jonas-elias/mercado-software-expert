<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Model\Imposto;

use ExpertFramework\Database\BaseModel;

/**
 * class ImpostoModel.
 *
 * @author jonas-elias
 */
class ImpostoModel extends BaseModel
{
    /**
     * @var string
     */
    protected static string $table = 'imposto';

    /**
     * @var array
     */
    protected static array $columns = ['*'];
}
