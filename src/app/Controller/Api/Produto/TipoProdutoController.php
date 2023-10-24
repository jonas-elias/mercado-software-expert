<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Produto;

use ExpertFramework\Container\Container;
use ExpertFramework\Http\Contract\ResponseInterface;
use Jonaselias\ExpertFramework\Controller\Controller;
use Jonaselias\ExpertFramework\Repository\Produto\TipoProdutoRepository;
use Jonaselias\ExpertFramework\Validation\Produto\TipoProdutoValidation;

/**
 * class TipoProdutoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class TipoProdutoController extends Controller
{
    /**
     * @var TipoProdutoValidation $tipoProdutoValidation
     */
    protected TipoProdutoValidation $tipoProdutoValidation;

    /**
     * @var TipoProdutoRepository $tipoProdutoRepository
     */
    protected TipoProdutoRepository $tipoProdutoRepository;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tipoProdutoValidation = Container::get(
            'Jonaselias\ExpertFramework\Validation\Produto\TipoProdutoValidation'
        );
        $this->tipoProdutoRepository = Container::get(
            'Jonaselias\ExpertFramework\Repository\Produto\TipoProdutoRepository'
        );
    }

    /**
     * @OA\Post(
     *     path="/api/tipoProduto",
     *     tags={"produto"},
     *     summary="Insere o produto no banco de dados.",
     *     operationId="insereTipoProduto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="nome",
     *                     description="Nome da categoria do produto",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="descricao",
     *                     description="Descrição da categoria do produto",
     *                     type="string"
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
     *                  summary="Tipo do produto criado com sucesso"
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
    public function insereTipoProduto()
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'nome' => $body['nome'] ?? '',
            'descricao' => $body['descricao'] ?? '',
        ];
        try {
            $this->tipoProdutoValidation->validaInsercao($atributos);
            $this->tipoProdutoRepository->insereTipoProduto($atributos);

            $response = $this->constructCreatedMessage();
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
     *     path="/api/tipoProduto",
     *     tags={"produto"},
     *     summary="Recupera os tipos dos produtos.",
     *     operationId="getTiposProdutos",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Dados recuperados com sucesso"
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
    public function getTiposProdutos()
    {
        try {
            $tiposProdutos = $this->tipoProdutoRepository->getTiposProdutos();
            $response = $this->constructCreatedMessage($tiposProdutos);
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/tipoProduto/{id}",
     *     tags={"produto"},
     *     summary="Atualiza o tipo do produto no banco de dados.",
     *     operationId="atualizaTipoProduto",
     *     @OA\RequestBody(
     *         description="Formato de envio",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="nome",
     *                     description="Nome da categoria do produto",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="descricao",
     *                     description="Descrição da categoria do produto",
     *                     type="string"
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
     *                  summary="Tipo do produto atualizado com sucesso"
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
    public function atualizaTipoProduto(int $id)
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'nome' => $body['nome'] ?? '',
            'descricao' => $body['descricao'] ?? '',
        ];
        try {
            $this->tipoProdutoValidation->validaAtualizacao($atributos, $id);
            $this->tipoProdutoRepository->atualizaTipoProduto($atributos, $id);

            $response = $this->constructNoContentResponse();
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
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
     *     path="/api/tipoProduto/{id}",
     *     tags={"produto"},
     *     summary="Recupera um tipo de produto específico do banco de dados.",
     *     operationId="getTipoProdutoById",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Tipo de produto recuperado com sucesso"
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
    public function getTipoProdutoById(int $id): ResponseInterface
    {
        try {
            $this->tipoProdutoValidation->validaTipoProdutoById($id);
            $produto = $this->tipoProdutoRepository->getTipoProdutoById($id);

            $response = $this->constructSuccessResponse($produto);
        } catch (\InvalidArgumentException $iae) {
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/tipoProduto/{id}",
     *     tags={"produto"},
     *     summary="Remove um tipo de produto específico do banco de dados.",
     *     operationId="deleteTipoProdutoById",
     *     @OA\Response(
     *         response=204,
     *         description="No Content",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={},
     *                  summary="Tipo do produto removido com sucesso (soft delete)"
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
    public function deleteTipoProdutoById(int $id): ResponseInterface
    {
        try {
            $this->tipoProdutoValidation->validaTipoProdutoById($id);
            $this->tipoProdutoRepository->deletaTipoProdutoById($id);

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
