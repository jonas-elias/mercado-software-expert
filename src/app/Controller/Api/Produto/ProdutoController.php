<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Produto;

use Jonaselias\ExpertFramework\Controller\Controller;

/**
 * class ProdutoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class ProdutoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/produto",
     *     tags={"produto"},
     *     summary="Insere o produto no banco de dados.",
     *     operationId="insereProduto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="nome",
     *                     description="Nome do produto",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="descricao",
     *                     description="Descrição do produto",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="preco",
     *                     description="Preço do produto",
     *                     type="float"
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
     *                  summary="Produto criado com sucesso"
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
    public function insereProduto()
    {

    }

    /**
     * @OA\Get(
     *     path="/api/produto",
     *     tags={"produto"},
     *     summary="Recupera os produtos do mercado.",
     *     operationId="getProdutos",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Produtos recuperados com sucesso"
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
    public function getProdutos()
    {

    }

    /**
     * @OA\Put(
     *     path="/api/produto/{id}",
     *     tags={"produto"},
     *     summary="Atualiza o produto no banco de dados.",
     *     operationId="atualizaProduto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="nome",
     *                     description="Nome do produto",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="descricao",
     *                     description="Descrição do produto",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="preco",
     *                     description="Preço do produto",
     *                     type="float"
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
     *         response=204,
     *         description="No Content",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={},
     *                  summary="Produto atualizado com sucesso"
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
    public function atualizaProduto(int $id)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/produto/{id}",
     *     tags={"produto"},
     *     summary="Recupera um produto específico do banco de dados.",
     *     operationId="getProdutoById",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Produto recuperado com sucesso"
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
    public function getProdutoById(int $id)
    {

    }

    /**
     * @OA\Delete(
     *     path="/api/produto/{id}",
     *     tags={"produto"},
     *     summary="Remove um produto específico do banco de dados.",
     *     operationId="deleteProduto",
     *     @OA\Response(
     *         response=204,
     *         description="No Content",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={},
     *                  summary="Produto removido com sucesso (soft delete)"
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
    public function deleteProduto()
    {

    }
}
