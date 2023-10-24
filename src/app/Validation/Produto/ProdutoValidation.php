<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Produto;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class ProdutoValidation
 *
 * @package Jonaselias\ExpertFramework\Validation
 * @author jonas-elias
 */
class ProdutoValidation extends Validator
{
    /**
     * @var array $rules
     */
    protected array $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'preco' => 'required|float',
        'id_tipo_produto' => 'required|notExists:tipo_produto,id',
        'id' => 'required|notExists:produto,id',
    ];

    /**
     * validate insert product
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
            'preco' => $this->rules['preco'],
            'id_tipo_produto' => $this->rules['id_tipo_produto']
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * validate update product
     *
     * @param ?array $atributos
     * @param ?int $id
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validaAtualizacao(?array $atributos, ?int $id): void
    {
        $regras = [
            'nome' => $this->rules['nome'],
            'descricao' => $this->rules['descricao'],
            'preco' => $this->rules['preco'],
            'id_tipo_produto' => $this->rules['id_tipo_produto'],
            'id' => $this->rules['id'],
        ];

        $this->validator->validate(array_merge($atributos, ['id' => $id]), $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate id product
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
