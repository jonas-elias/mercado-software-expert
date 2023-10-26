<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller\Api\Venda;

use ExpertFramework\Container\Contract\ContainerInterface;
use Jonaselias\ExpertFramework\Controller\Controller;
use Jonaselias\ExpertFramework\Repository\Venda\ItemVendaRepository;
use Jonaselias\ExpertFramework\Validation\Venda\ItemVendaValidation;

/**
 * class ItemVendaController.
 *
 * @author jonas-elias
 */
class ItemVendaController extends Controller
{
    /**
     * @var ItemVendaValidation
     */
    protected ItemVendaValidation $itemVendaValidation;

    /**
     * @var ItemVendaRepository
     */
    protected ItemVendaRepository $itemVendaRepository;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct($this->container);
        $this->itemVendaValidation = $this->container::get(
            'Jonaselias\ExpertFramework\Validation\Venda\ItemVendaValidation'
        );
        $this->itemVendaRepository = $this->container::get(
            'Jonaselias\ExpertFramework\Repository\Venda\ItemVendaRepository'
        );
    }

    /**
     * @OA\Post(
     *     path="/api/itemVenda",
     *     tags={"venda"},
     *     summary="Insere os itens da venda no banco de dados.",
     *     operationId="insereItensVenda",
     *
     *     @OA\RequestBody(
     *     description="Formato de envio",
     *
     *     @OA\MediaType(
     *         mediaType="application/json",
     *
     *         @OA\Schema(
     *             type="object",
     *
     *             @OA\Property(
     *                 property="venda",
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
     *             ),
     *             @OA\Property(
     *                 property="itens_venda",
     *                 type="object",
     *                 type="array",
     *
     *                 @OA\Items(
     *
     *                      @OA\Property(
     *                          property="id_produto",
     *                          description="Id do produto",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="valor_item",
     *                          description="Valor do item",
     *                          type="float"
     *                      ),
     *                      @OA\Property(
     *                          property="valor_imposto",
     *                          description="Valor do imposto",
     *                          type="float"
     *                      ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *  ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(
     *
     *              @OA\Schema(type="string"),
     *
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "sucesso", "mensagem": "Operação bem-sucedida.", "dados": {}},
     *                  summary="Itens de venda criados com sucesso"
     *              ),
     *          )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *
     *         @OA\JsonContent(
     *
     *              @OA\Schema(type="string"),
     *
     *              @OA\Examples(
     *                  example="string",
     *                  value={"status": "erro", "mensagem": "Requisição inválida.", "dados": {}, "detalhes_erro": {}},
     *                  summary="Requisição inválida"
     *              ),
     *          )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *
     *         @OA\JsonContent(
     *
     *              @OA\Schema(type="string"),
     *
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
    public function insereItensVenda()
    {
        $body = $this->request->body() ?? [];
        $atributos = [
            'venda' => [
                'total_impostos' => (float) ($body['venda']['total_impostos'] ?? null),
                'total_venda'    => (float) ($body['venda']['total_venda'] ?? null),
            ],
        ];

        try {
            $this->itemVendaRepository->begin();
            $this->itemVendaValidation->validaInsercaoVenda($atributos['venda']);
            $idVenda = $this->itemVendaRepository->insereVendaGetId($atributos['venda']);

            $atributos = $this->itemVendaValidation->formatItensVenda($body['itens_venda'], $idVenda);
            $this->itemVendaValidation->validaInsercaoItensVenda($atributos);
            $this->itemVendaRepository->insereItemVenda($atributos);

            $this->itemVendaRepository->commit();
            $response = $this->constructCreatedMessageResponse();
        } catch (\InvalidArgumentException $iae) {
            $this->itemVendaRepository->rollback();
            $response = $this->constructClientErrorResponse($iae->getMessage());
        } catch (\Throwable $th) {
            $this->itemVendaRepository->rollback();
            $response = $this->constructServerErrorResponse();
        } finally {
            return $this->response->json($response['response'], $response['statusCode']);
        }
    }
}
