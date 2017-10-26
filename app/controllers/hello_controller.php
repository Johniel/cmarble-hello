<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HelloController extends AppController
{
    /**
     * @params ServerRequestInterface $request
     * @params ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write("<h1>" . Hello::getMessage() . "</h1>");
        return $response->withStatus(200);
    }

    /**
     * @params ServerRequestInterface $request
     * @params ResponseInterface $response
     * @return ResponseInterface
     */
    public function not_found(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withStatus(404);
    }

    /**
     * @params ServerRequestInterface $request
     * @params ResponseInterface $response
     * @return ResponseInterface
     */
    public function runtime_error(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withStatus(500);
    }

    /**
     * @params ServerRequestInterface $request
     * @params ResponseInterface $response
     * @return ResponseInterface
     */
    public function echo(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write("<h1>" . $request->getQueryParams()['message'] ?? '' . "</h1>");
        return $response->withStatus(200);
    }
}
