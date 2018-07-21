<?php
    class Routes {

        private $routes;

        public function __construct() {
            $this->routes = include(dirname(dirname(__FILE__)).'/config/routes.php');
        }

        private function getUri() {
            if (!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run() {
            $uri = $this->getUri();

            foreach ($this->routes as $uri_pattern=>$path) {

                if (preg_match("~$uri_pattern~", $uri)) {

                    $inner_path = preg_replace("~$uri_pattern~", $path, $uri);


                    $segments = explode('/',$inner_path);

                    $controller = array_shift($segments).'Controller';

                    $controller = ucfirst($controller);

                    $method = array_shift($segments);

                    $params = $segments;

                    $controller_file = dirname(dirname(__FILE__)).'/controllers/'.$controller.'.php';

                    if (file_exists($controller_file)) {
                        include_once($controller_file);

                        $controller_object = new $controller;

                        if (!empty($params)) {
                            if (method_exists($controller_object, $method)){
                                call_user_func_array(array($controller_object, $method), $params);
                                $result = true;
                            }

                        } else {
                            if (method_exists($controller_object, $method)) {
                                $controller_object->$method();
                                $result = true;
                            }
                        }
                        if ($result == true){
                            break;
                        }
                    }
                }
            }

            if (empty($result)) {

                header('HTTP/1.1 404 Not Found');
                include_once(dirname(dirname(__FILE__)).'/controllers/ErrorsController.php');
                $error = new ErrorsController;
                $error->page_not_found();
            }

        }

    }