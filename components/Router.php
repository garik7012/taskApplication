<?php
/**
 *
 */
class Router
{
    private $routes;

    /**
     * определяем файл с маршрутами и подключаем
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns строка запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определяем контроллер, action, параметры

                $segments = explode('@', $internalRoute);

                $controllerName = array_shift($segments);
                $controllerName = ucfirst($controllerName);

                $actionName = ucfirst(array_shift($segments));

                $parameters = $segments;

                // Подключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создаем объект, вызваем action
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
