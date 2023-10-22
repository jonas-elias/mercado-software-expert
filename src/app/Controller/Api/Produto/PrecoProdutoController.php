<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Produto;

use Jonaselias\ExpertFramework\Controller\Controller;

/**
 * class PrecoProdutoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class PrecoProdutoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/precoProduto",
     *     tags={"produto"},
     *     summary="Insere o preço do produto no banco de dados.",
     *     operationId="inserePrecoProduto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="valor",
     *                     description="Valor produto",
     *                     type="float",
     *                 ),
     *                 @OA\Property(
     *                     property="id_produto",
     *                     description="Id produto",
     *                     type="integer"
     *                 ),
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Preço do produto criado com sucesso"
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "erro", "mensagem": "Requisição inválida.", "dados": {}, "detalhes_erro": {}},
     *                  summary="Requisição inválida"
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={
     *                      "status": "erro", "mensagem": "Erro interno do servidor", "dados": {}, "detalhes_erro": {}
     *                  },
     *                  summary="Erro no servidor"
     *              ),
     *          )
     *     )
     * )
     */
    public function inserePrecoProduto()
    {

    }
}
