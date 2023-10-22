<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Venda;

use Jonaselias\ExpertFramework\Controller\Controller;

/**
 * class VendaController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class VendaController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/venda",
     *     tags={"venda"},
     *     summary="Insere a venda no banco de dados.",
     *     operationId="insereVenda",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="total_compra",
     *                     description="Total da compra",
     *                     type="float",
     *                 ),
     *                 @OA\Property(
     *                     property="total_impostos",
     *                     description="Total impostos",
     *                     type="float"
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
     *                  summary="Venda criada com sucesso"
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
    public function insereVenda()
    {

    }
}
