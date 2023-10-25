<?php

namespace Jonaselias\ExpertFramework\Validation;

use ExpertFramework\Container\Container;
use ExpertFramework\Validation\Validation;

/**
 * class Validator.
 *
 * @author jonas-elias
 */
class Validator
{
    /**
     * @var Validation
     */
    protected Validation $validator;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->validator = Container::get('ExpertFramework\Validation\Validation');
    }
}
