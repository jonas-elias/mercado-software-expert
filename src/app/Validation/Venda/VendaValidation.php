<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Venda;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class VendaValidation.
 *
 * @author jonas-elias
 */
class VendaValidation extends Validator
{
    /**
     * @var array
     */
    private array $rules = [
        'total_impostos' => 'nullable|float',
        'total_venda'    => 'required|float',
        'id'             => 'required|notExists:venda,id',
    ];

    /**
     * validate insert venda.
     *
     * @param ?array $atributos
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaInsercaoVenda(?array $atributos): void
    {
        $regras = [
            'total_impostos' => $this->rules['total_impostos'],
            'total_venda'    => $this->rules['total_venda'],
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * validate update venda.
     *
     * @param ?array $atributos
     * @param ?int   $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaAtualizacao(?array $atributos, ?int $id): void
    {
        $regras = [
            'total_impostos' => $this->rules['total_impostos'],
            'total_compra'   => $this->rules['total_compra'],
        ];

        $this->validator->validate(array_merge($atributos, ['id' => $id]), $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate id venda.
     *
     * @param int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
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
