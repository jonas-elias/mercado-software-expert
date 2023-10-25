<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Produto;

use ExpertFramework\Container\Container;
use ExpertFramework\Http\Contract\ResponseInterface;
use Jonaselias\ExpertFramework\Controller\Controller;
use Jonaselias\ExpertFramework\Validation\Produto\ProdutoValidation;
use Jonaselias\ExpertFramework\Repository\Produto\ProdutoRepository;

/**
 * class ProdutoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class ProdutoController extends Controller
{
    /**
     * @var ProdutoValidation $produtoValidation
     */
    protected ProdutoValidation $produtoValidation;

    /**
     * @var ProdutoRepository $produtoRepository
     */
    protected ProdutoRepository $produtoRepository;

    /**
     * Method constructor
     *
     * @param ProdutoValidation
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->produtoValidation = Container::get('Jonaselias\ExpertFramework\Validation\Produto\ProdutoValidation');
        $this->produtoRepository = Container::get('Jonaselias\ExpertFramework\Repository\Produto\ProdutoRepository');
    }

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
    public function insereProduto(): ResponseInterface
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'nome' => $body['nome'] ?? null,
            'descricao' => $body['descricao'] ?? null,
            'preco' => (float) ($body['preco'] ?? null),
            'id_tipo_produto' => $body['id_tipo_produto'] ?? null,
        ];
        try {
            $this->produtoValidation->validaInsercao($atributos);
            $this->produtoRepository->insereProduto($atributos);

            $response = $this->constructCreatedMessageResponse();
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
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
    public function getProdutos(): ResponseInterface
    {
        try {
            $dados = $this->produtoRepository->getProdutos();
            $response = $this->constructSuccessResponse($dados);
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
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
    public function atualizaProduto(int $id): ResponseInterface
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'nome' => $body['nome'] ?? null,
            'descricao' => $body['descricao'] ?? null,
            'preco' => (float) ($body['preco'] ?? null),
            'id_tipo_produto' => $body['id_tipo_produto'] ?? null,
        ];
        try {
            $this->produtoValidation->validaAtualizacao($atributos, $id);
            $this->produtoRepository->atualizaProduto($atributos, $id);

            $response = $this->constructNoContentResponse();
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            if (isset($response['response'])) {
                return $this->response->json($response['response'], $response['statusCode']);
            }
            return $this->response->status($response['statusCode']);
        }
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
    public function getProdutoById(int $id): ResponseInterface
    {
        try {
            $this->produtoValidation->validaProdutoById($id);
            $produto = $this->produtoRepository->getProdutoById($id);

            $response = $this->constructSuccessResponse($produto);
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
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
    public function deleteProdutoById(int $id): ResponseInterface
    {
        try {
            $this->produtoValidation->validaProdutoById($id);
            $this->produtoRepository->deletaProdutoById($id);

            $response = $this->constructNoContentResponse();
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            if (isset($response['response'])) {
                return $this->response->json($response['response'], $response['statusCode']);
            }
            return $this->response->status($response['statusCode']);
        }
    }
}
