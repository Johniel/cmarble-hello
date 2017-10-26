<?php

class Dispatcher
{
    public static function invoke()
    {
        $body = new Stream();
        $body->write(file_get_contents('php://input'));
        $body->rewind();

        $request = new Request();
        $request = $request->withMethod($_SERVER['REQUEST_METHOD']);
        foreach (getallheaders() as $key => $value) {
            $request = $request->withHeader($key, $value);
        }
        $request = $request->withCookieParams($_COOKIE);
        $request = $request->withServerParams($_SERVER);
        $request = $request->withBody($body);
        $request = $request->withUri(new Uri($_SERVER['REQUEST_URI']));

        $response = new Response();
        $response = $response->withBody(new Stream());

        list($controller_name, $action_name) = static::parseAction($request->getQueryParams()[CM_ACTION] ?? '');
        $controller = static::getController($controller_name);
        
        $controller->action = $action_name;
        $controller->beforeFilter();
        $controller->dispatchAction($request, $response);
        $controller->afterFilter();
    }

    /**
     * コントローラ/アクション名を取得する
     *
     * url は必ず http://example.com/index.php?cm_action=controller-name/action-name の形
     *
     * @param string $action
     * @return array
     * @throws CMException
     */
    public static function parseAction($action)
    {
        $action = explode('/', $action);

        if (count($action) < 2) {
            throw new CMException('invalid url format');
        }
        $action_name = array_pop($action);
        $controller_name = join("_", $action);

        return array($controller_name, $action_name);
    }

    /**
     *
     * @param string $controller_name
     * @return Controller
     * @throws DCException
     */
    public static function getController($controller_name)
    {
        $controller_class = Inflector::camelize($controller_name) . 'Controller';

        if (!class_exists($controller_class)) {
            throw new DCException("{$controller_class} is not found");
        }

        return new $controller_class($controller_name);
    }
}
