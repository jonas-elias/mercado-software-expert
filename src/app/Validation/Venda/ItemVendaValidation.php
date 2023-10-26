<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Validation\Venda;

/**
 * class ItemVendaValidation.
 *
 * @author jonas-elias
 */
class ItemVendaValidation extends VendaValidation
{
    /**
     * @var array
     */
    protected array $rules = [
        'valor_imposto' => 'nullable|float',
        'valor_item'    => 'required|float',
        'id_produto'    => 'required|notExists:produto,id',
        'id_venda'      => 'required|notExists:venda,id',
        'id'            => 'required|notExists:itens_venda,id',
    ];

    /**
     * validate insert item venda.
     *
     * @param ?array $atributos
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function validaInsercaoItensVenda(?array $atributos): void
    {
        foreach ($atributos as $value) {
            $regras = [
                'valor_imposto' => $this->rules['valor_imposto'],
                'valor_item'    => $this->rules['valor_item'],
                'id_produto'    => $this->rules['id_produto'],
                'id_venda'      => $this->rules['id_venda'],
            ];

            $this->validator->validate($value, $regras);

            if ($this->validator->fails()) {
                throw new \InvalidArgumentException(json_encode($this->validator->errors()));
            }
        }
    }

    /**
     * Method to format itens venda.
     *
     * @param ?array $atributos
     * @param int    $idVenda
     *
     * @return array
     */
    public function formatItensVenda(?array $atributos, int $idVenda): array
    {
        $novosAtributos = [];
        foreach ($atributos as $itemVenda) {
            $novosAtributos[] = [
                'id_venda'      => $idVenda,
                'id_produto'    => $itemVenda['id_produto'] ?? null,
                'valor_item'    => (float) ($itemVenda['valor_item'] ?? null),
                'valor_imposto' => (float) ($itemVenda['valor_imposto'] ?? null),
            ];
        }

        return $novosAtributos;
    }
}
