<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Produto;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class TipoProdutoValidation
 *
 * @package Jonaselias\ExpertFramework\Validation\Produto
 * @author jonas-elias
 */
class TipoProdutoValidation extends Validator
{
    /**
     * Method to validate insert type product
     *
     * @param ?array $atributos
     * @return void
     */
    public function validateInsert(?array $atributos): void
    {
        $regras = [
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }
}
