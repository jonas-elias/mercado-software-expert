<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Produto;

use Jonaselias\ExpertFramework\Validation\Validator;

/**
 * class TipoProdutoValidation.
 *
 * @author jonas-elias
 */
class TipoProdutoValidation extends Validator
{
    /**
     * @var array
     */
    protected array $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'id' => 'required|notExists:tipo_produto,id',
        'id_delete' => 'required|notExists:tipo_produto,id|exists:imposto,id_tipo_produto|exists:produto,id_tipo_produto',
    ];

    /**
     * Method to validate insert type product.
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
            'nome' => $this->rules['nome'],
            'descricao' => $this->rules['descricao'],
        ];

        $this->validator->validate($atributos, $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }

    /**
     * Method to validate update type product.
     *
     * @param ?array $atributos
     * @param ?int   $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
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
     * Method to validate tipo id type product.
     *
     * @param ?int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
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

    /**
     * Method to validate delete by id type product.
     *
     * @param ?int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaDeleteById(?int $id): void
    {
        $regras = [
            'id' => $this->rules['id_delete'],
        ];

        $this->validator->validate(['id' => $id], $regras);

        if ($this->validator->fails()) {
            throw new \InvalidArgumentException(json_encode($this->validator->errors()));
        }
    }
}
