<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Imposto;

use ExpertFramework\Container\Container;
use ExpertFramework\Http\Contract\ResponseInterface;
use Jonaselias\ExpertFramework\Controller\Controller;
use Jonaselias\ExpertFramework\Validation\Imposto\ImpostoValidation;
use Jonaselias\ExpertFramework\Repository\Imposto\ImpostoRepository;

/**
 * class ImpostoController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class ImpostoController extends Controller
{
    /**
     * @var ImpostoValidation $impostoValidation
     */
    protected ImpostoValidation $impostoValidation;

    /**
     * @var ImpostoRepository $impostoRepository
     */
    protected ImpostoRepository $impostoRepository;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->impostoValidation = Container::get('Jonaselias\ExpertFramework\Validation\Imposto\ImpostoValidation');
        $this->impostoRepository = Container::get('Jonaselias\ExpertFramework\Repository\Imposto\ImpostoRepository');
    }

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
    public function insereImposto(): ResponseInterface
    {
        $body = $this->request->body();
        $atributos = [
            'valor' => (float) ($body['valor'] ?? null),
            'id_tipo_produto' => $body['id_tipo_produto'] ?? '',
        ];

        try {
            $this->impostoValidation->validaInsercao($atributos);
            $this->impostoRepository->insereImposto($atributos);

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
     *     path="/api/imposto",
     *     tags={"imposto"},
     *     summary="Recupera o imposto dos tipos de produto.",
     *     operationId="getImpostos",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Impostos recuperados com sucesso"
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
    public function getImpostos(): ResponseInterface
    {
        try {
            $dados = $this->impostoRepository->getImpostos();
            $response = $this->constructSuccessResponse($dados);
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/imposto/{id}",
     *     tags={"imposto"},
     *     summary="Atualiza o imposto no banco de dados.",
     *     operationId="atualizaImposto",
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
     *                  summary="Imposto atualizado com sucesso"
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
    public function atualizaImposto(int $id): ResponseInterface
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'valor' => $body['valor'] ?? null,
        ];

        try {
            $this->impostoValidation->validaAtualizacao($atributos, $id);
            $this->impostoRepository->atualizaImposto($atributos, $id);

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
     *     path="/api/imposto/{id}",
     *     tags={"imposto"},
     *     summary="Recupera um imposto específico do banco de dados.",
     *     operationId="getImpostoById",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Imposto recuperado com sucesso"
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
    public function getImpostoById(int $id): ResponseInterface
    {
        try {
            $this->impostoValidation->validaImpostoById($id);
            $imposto = $this->impostoRepository->getImpostoById($id);

            $response = $this->constructSuccessResponse($imposto);
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
     *     path="/api/imposto/{id}",
     *     tags={"imposto"},
     *     summary="Remove um imposto específico do banco de dados.",
     *     operationId="deleteImpostoById",
     *     @OA\Response(
     *         response=204,
     *         description="No Content",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={},
     *                  summary="Imposto removido com sucesso (soft delete)"
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
    public function deleteImpostoById(int $id): ResponseInterface
    {
        try {
            $this->impostoValidation->validaImpostoById($id);
            $this->impostoRepository->deletaImpostoById($id);

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
