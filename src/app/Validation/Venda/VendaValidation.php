<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Venda;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class VendaValidation
 *
 * @package Jonaselias\ExpertFramework\Validation
 * @author jonas-elias
 */
class VendaValidation extends Validator
{
    /**
     * @var array $rules
     */
    private array $rules = [
        'total_impostos' => 'required|float',
        'total_venda' => 'required|float',
        'id' => 'required|notExists:venda,id',
    ];

    /**
     * validate insert venda
     *
     * @param ?array $atributos
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaInsercaoVenda(?array $atributos): void
    {
        $regras = [
            'total_impostos' => $this->rules['total_impostos'],
            'total_venda' => $this->rules['total_venda'],
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * validate update venda
     *
     * @param ?array $atributos
     * @param ?int $id
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaAtualizacao(?array $atributos, ?int $id): void
    {
        $regras = [
            'total_impostos' => $this->rules['total_impostos'],
            'total_compra' => $this->rules['total_compra'],
        ];

        $this->validator->validate(array_merge($atributos, ['id' => $id]), $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate id venda
     *
     * @param int $id
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaProdutoById(?int $id): void
    {
        $regras = [
            'id' => $this->rules['id'],
        ];

        $this->validator->validate(['id' => $id], $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }
}
