<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Controller
{
    public $name;
    public $action;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function beforeFilter()
    {
    }

    public function afterFilter()
    {
    }

    public function dispatchAction(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (!static::isAction($this->action)) {
            // アクション名が予約語などで正しくないとき
            throw new DCException('invalid action name');
        }

        if (!method_exists($this, '__call')) {
            if (!method_exists($this, $this->action)) {
                // アクションがコントローラに存在しないとき
                throw new DCException(sprintf('Action "%s::%s()" does not exist', get_class($this), $this->action));
            }
            $method = new ReflectionMethod($this, $this->action);
            if (!$method->isPublic()) {
                // アクションが public メソッドではないとき
                throw new DCException('action is not public');
            }
        }

        // アクションの実行
        $response = $this->{$this->action}($request, $response);

        $this->render($response);
    }

    // アクション名の妥当性を検証する
    public static function isAction($action)
    {
        $methods = get_class_methods('Controller');
        return !in_array($action, $methods);
    }

    public function beforeRender()
    {
    }

    public function render(ResponseInterface $response)
    {
        static $is_rendered = false;

        if ($is_rendered) {
            return;
        }

        $this->beforeRender();
        http_response_code($response->getStatusCode());
        echo $response->getBody();
        $is_rendered = true;
    }
}
