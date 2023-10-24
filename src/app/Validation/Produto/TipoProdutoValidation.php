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
     * @var array $rules
     */
    protected array $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'id' => 'required|notExists:tipo_produto,id|softDelete:tipo_produto,id,data_exclusao,0001-01-01'
    ];

    /**
     * Method to validate insert type product
     *
     * @param ?array $atributos
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaInsercao(?array $atributos): void
    {
        $regras = [
            'nome' => $this->rules['nome'],
            'descricao' => $this->rules['descricao'],
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate update type product
     *
     * @param ?array $atributos
     * @param ?int $id
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaAtualizacao(array $atributos, ?int $id): void
    {
        $regras = [
            'nome' => $this->rules['nome'],
            'descricao' => $this->rules['descricao'],
            'id' => $this->rules['id'],
        ];

        $this->validator->validate(array_merge($atributos, ['id' => $id]), $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate update type product
     *
     * @param ?int $id
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaTipoProdutoById(?int $id): void
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
