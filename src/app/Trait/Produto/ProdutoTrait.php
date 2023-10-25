<?php

namespace Jonaselias\ExpertFramework\Trait\Produto;

/**
 * trait ProdutoTrait.
 *
 * class ProdutoTrait
 *
 * @author jonas-elias
 */
trait ProdutoTrait
{
    /**
     * Method to format inputs produto.
     *
     * @param array $produto
     *
     * @return array
     */
    public function formatCasasDecimaisProduto(array $produto): array
    {
        if (isset($produto['preco'])) {
            $produto['preco'] = number_format((float) $produto['preco'], 2);
            $produto['imposto_porcentagem'] = number_format((float) $produto['imposto_porcentagem'], 2);
            $produto['valor_imposto'] = number_format((float) $produto['valor_imposto'], 2);
            $produto['total'] = number_format((float) $produto['total'], 2);
        }

        return $produto;
    }
}
