<?php

namespace Jonaselias\ExpertFramework\Controller;
use ExpertFramework\Container\Container;
use ExpertFramework\Http\Contract\RequestInterface;
use ExpertFramework\Http\Contract\ResponseInterface;

/**
 * class Controller
 * @package Jonaselias\ExpertFramework\Controller
 * @author jonas-elias
 */
class Controller
{
    /**
     * @var ResponseInterface $response
     */
    public ResponseInterface $response;

    /**
     * @var RequestInterface $request
     */
    public RequestInterface $request;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->response = Container::get('ExpertFramework\Http\Response');
        $this->request = Container::get('ExpertFramework\Http\Request');
    }
}
