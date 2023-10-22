<?php

namespace Jonaselias\ExpertFramework\Controller\Api\Imposto;

/**
 * class ImpostoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class ImpostoController
{
    /**
     * @OA\Post(
     *     path="/api/imposto",
     *     tags={"imposto"},
     *     summary="Insere o percentual de imposto atrelado ao tipo de produto.",
     *     operationId="insereImposto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="valor",
     *                     description="Percentual de imposto (formato = 10 para 10%, 20 para 20%, ...)",
     *                     type="float",
     *                 ),
     *                 @OA\Property(
     *                     property="id_tipo_produto",
     *                     description="Tipo do produto",
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
     *                  summary="Imposto criado com sucesso"
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
    public function insereImposto()
    {

    }
}
