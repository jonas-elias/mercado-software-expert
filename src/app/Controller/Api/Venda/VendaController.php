<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Venda;

use ExpertFramework\Container\Container;
use ExpertFramework\Http\Contract\ResponseInterface;
use Jonaselias\ExpertFramework\Controller\Controller;
use Jonaselias\ExpertFramework\Repository\Venda\VendaRepository;
use Jonaselias\ExpertFramework\Validation\Venda\VendaValidation;

/**
 * class VendaController
 *
 * @package Jonaselias\ExpertFramework\Controller\Api
 * @author jonas-elias
 */
class VendaController extends Controller
{
    /**
     * @var VendaValidation $vendaValidation
     */
    protected VendaValidation $vendaValidation;

    /**
     * @var VendaRepository $produtoRepository
     */
    protected VendaRepository $vendaRepository;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->vendaValidation = Container::get('Jonaselias\ExpertFramework\Validation\Venda\VendaValidation');
        $this->vendaRepository = Container::get('Jonaselias\ExpertFramework\Repository\Venda\VendaRepository');
    }

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
     *                     property="total_venda",
     *                     description="Total da venda",
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
        $body = $this->request->body() ?? [];
        $atributos = [
            'total_impostos' => (float) ($body['total_impostos'] ?? null),
            'total_venda' => (float) ($body['total_venda'] ?? null),
        ];
        try {
            $this->vendaValidation->validaInsercaoVenda($atributos);
            $this->vendaRepository->insereVenda($atributos);

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
     *     path="/api/venda",
     *     tags={"venda"},
     *     summary="Recupera as vendas do mercado.",
     *     operationId="getVendas",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Schema(type="string"),
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Vendas recuperadas com sucesso"
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
    public function getVendas(): ResponseInterface
    {
        try {
            $dados = $this->vendaRepository->getVendas();
            $response = $this->constructSuccessResponse($dados);
        } catch (\Throwable $th) {
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
    }
}
