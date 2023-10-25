<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Imposto;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class ImpostoValidation.
 *
 * @author jonas-elias
 */
class ImpostoValidation extends Validator
{
    /**
     * @var array
     */
    protected array $rules = [
        'valor' => 'required|float',
        /**
         * Id tipo produto é único na tabela de imposto, justificando a quantidade de validações.
         */
        'id_tipo_produto' => 'required|notExists:tipo_produto,id|softDelete:tipo_produto,id,data_exclusao,0001-01-01
            |exists:imposto,id_tipo_produto',
        'id' => 'required|notExists:imposto,id|softDelete:imposto,id,data_exclusao,0001-01-01',
    ];

    /**
     * validate insert imposto.
     *
     * @param ?array $atributos
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaInsercao(?array $atributos): void
    {
        $regras = [
            'valor'           => $this->rules['valor'],
            'id_tipo_produto' => $this->rules['id_tipo_produto'],
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * validate update imposto.
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
            'valor' => $this->rules['valor'],
            'id'    => $this->rules['id'],
        ];

        $this->validator->validate(array_merge($atributos, ['id' => $id]), $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate id imposto.
     *
     * @param int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaImpostoById(?int $id): void
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
