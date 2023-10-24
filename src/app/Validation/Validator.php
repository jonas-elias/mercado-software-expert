<?php

namespace Jonaselias\ExpertFramework\Validation;

use ExpertFramework\Container\Container;
use ExpertFramework\Validation\Validation;

/**
 * class Validator
 *
 * @package Jonaselias\ExpertFramework\Validation\Produto
 * @author jonas-elias
 */
class Validator
{
    /**
     * @var Validation $validator
     */
    protected Validation $validator;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->validator = Container::get('ExpertFramework\Validation\Validation');
    }
}
