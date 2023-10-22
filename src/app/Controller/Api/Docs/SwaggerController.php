<?php

namespace Jonaselias\ExpertFramework\Controller\Api\Docs;

use ExpertFramework\Http\Contract\ResponseInterface;
use Jonaselias\ExpertFramework\Controller\Controller;

/**
 * @OA\Info(title="Mercado Software Expert", version="1.0")
 */
class SwaggerController extends Controller
{
    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @OA\Get(
     *     path="/api",
     *     summary="Lista o yaml para carregar a documentação swagger.",
     *     operationId="yaml",
     *     tags={"doc"},
     *     @OA\Response(
     *         response=200,
     *         description="Yaml contendo a documentação especificada da aplicação."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="file.yaml"
     *     )
     * )
     */
    public function yaml(): ResponseInterface
    {
        $path = config('swagger.path');

        $openapi = \OpenApi\Generator::scan([$path]);
        return $this->response->yaml($openapi->toYaml());
    }

    /**
     * Method to get doc swagger
     *
     * @return string
     */
    public function doc(): string
    {
        return render('docs.docs');
    }
}
