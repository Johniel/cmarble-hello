<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HelloController extends AppController
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write("<h1>" . Hello::getMessage() . "</h1>");
        return $response->withStatus(200);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function not_found(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->withStatus(404);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function echo(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write("<h1>" . $request->getQueryParams()['message'] ?? '' . "</h1>");
        return $response->withStatus(200);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function twig(ServerRequestInterface $request, ResponseInterface $response)
    {
        $view = new \Slim\Views\Twig(APP_DIR . 'views', ['cache' => APP_DIR . 'tmp/views']);
        return $view->render($response, 'hello.twig', ['name' => 'twig-view']);
    }
}
