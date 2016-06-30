<?php

class Route {

    static function init() {
	// default controller  and action
	$controllerName = DEFAULT_CONTROLLER;
	$actionName = DEFAULT_ACTION;
	$actionParams = '';

	$routes = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
	//var_dump($routes);die;
	// get controller name
	if (!empty($routes[1])) {
	    $controllerName = $routes[1];
	}

	// get action name
	if (!empty($routes[2])) {
	    $actionName = $routes[2];
	}
	
	// get action parameters
	if(!empty($routes[3])){
	    $actionParams = $routes[3];
	}
	// preficses
	$modelName = $controllerName;
	$controllerName = $controllerName . 'Controller';
	$actionName = 'action' . $actionName;

	// get model file
	$modelFile = $modelName . '.php';
	$modelPath = "models/" . $modelFile;
	if (file_exists($modelPath)) {
	    require_once $modelPath;
	}
	// get controller file
	$controllerFile = $controllerName . '.php';
	$controllerPath = "controllers/" . $controllerFile;
	if (file_exists($controllerPath)) {
	    require_once $controllerPath;
	} else {
	    throw new Exception('Page not found', 404);
	}

	// create controller
	$controller = new $controllerName();
	$action = $actionName;
	$params = $actionParams;
	if (method_exists($controller, $action)) {
	    // launch controller action
	    $controller->$action($params);
	} else {
	    throw new Exception('Page not found', 404);
	}
    }

}
