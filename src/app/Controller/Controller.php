<?php

declare(strict_types=1);

namespace Jonaselias\ExpertFramework\Controller;

use ExpertFramework\Container\Contract\ContainerInterface;
use ExpertFramework\Http\Contract\RequestInterface;
use ExpertFramework\Http\Contract\ResponseInterface;

/**
 * class Controller.
 *
 * @author jonas-elias
 */
class Controller
{
    /**
     * @var ResponseInterface
     */
    public ResponseInterface $response;

    /**
     * @var RequestInterface
     */
    public RequestInterface $request;

    /**
     * Method constructor.
     *
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        $this->response = $this->container::get('ExpertFramework\Http\Response');
        $this->request = $this->container::get('ExpertFramework\Http\Request');
    }

    /**
     * Method to construct success response.
     *
     * @param ?array $data
     *
     * @return array
     */
    protected function constructSuccessResponse(?array $data = []): array
    {
        $response = [
            'status'   => config('api.mensagens.sucesso.status'),
            'mensagem' => config('api.mensagens.sucesso.mensagem'),
            'dados'    => $data,
        ];
        $statusCode = 200;

        return compact('response', 'statusCode');
    }

    /**
     * Method to construct created message.
     *
     * @param ?array $data
     *
     * @return array
     */
    protected function constructCreatedMessageResponse(?array $data = []): array
    {
        $response = [
            'status'   => config('api.mensagens.sucesso.status'),
            'mensagem' => config('api.mensagens.sucesso.mensagem'),
            'dados'    => $data,
        ];
        $statusCode = 201;

        return compact('response', 'statusCode');
    }

    /**
     * Method to construct no content response.
     *
     * @return array
     */
    protected function constructNoContentResponse(): array
    {
        $statusCode = 204;

        return compact('statusCode');
    }

    /**
     * Method to construct client error message.
     *
     * @param string $errorMessage
     *
     * @return array
     */
    protected function constructClientErrorResponse(string $errorMessage): array
    {
        $response = [
            'status'        => config('api.mensagens.erro_cliente.status'),
            'mensagem'      => config('api.mensagens.erro_cliente.mensagem'),
            'dados'         => [],
            'detalhes_erro' => json_decode($errorMessage, true),
        ];
        $statusCode = 400;

        return compact('response', 'statusCode');
    }

    /**
     * Method to construct server error response.
     *
     * @return array
     */
    protected function constructServerErrorResponse(): array
    {
        $response = [
            'status'        => config('api.mensagens.erro_interno.status'),
            'mensagem'      => config('api.mensagens.erro_interno.mensagem'),
            'dados'         => [],
            'detalhes_erro' => [],
        ];
        $statusCode = 500;

        return compact('response', 'statusCode');
    }
}
