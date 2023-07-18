<?php

// Router.php

class Router
{
    protected array $routes = [];

    public function get($uri, $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }
    // Router.php

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Remove query string from the URI
        $uri = strtok($uri, '?');

        // Check if the requested route exists
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $action) {
                // Check if the action is a closure
                if ($action instanceof Closure) {
                    // If the route matches, execute the closure directly
                    if ($this->matchRoute($route, $uri)) {
                        $action();
                        return;
                    }
                } else {
                    // Convert the route to a regular expression
                    $pattern = '#^' . preg_replace('/{(\w+)}/', '(?<$1>[^/]+)', $route) . '$#';

                    // Attempt to match the URI against the regular expression
                    if (preg_match($pattern, $uri, $matches)) {
                        unset($matches[0]); // Remove the first element (full match)
                        $this->executeAction($action, $matches);
                        return;
                    }
                }
            }
        }

        // Handle 404 Not Found
        echo "<h1 style='text-align: center;'>404 | Not Found</h1>";

    }

    protected function executeAction($action, $routeParams): void
    {
        // Split the action string into controller and method
        $actionParts = explode('@', $action);
        $controllerName = $actionParts[0];
        $methodName = $actionParts[1];

        // Create an instance of the controller
        $controllerClassName = $controllerName;
        require_once __DIR__ . '/../app/controllers/' . $controllerClassName . '.php';
        $controller = new $controllerClassName();

        // Call the method on the controller with individual parameters using the splat operator
        call_user_func_array([$controller, $methodName], [$routeParams]);
    }


    protected function matchRoute($route, $uri, &$routeParams = []): bool
    {
        // Convert the route to a regular expression
        $pattern = '#^' . preg_replace('/{(\w+)}/', '(?<$1>[^/]+)', $route) . '/?$#';

        // Attempt to match the URI against the regular expression
        if (preg_match($pattern, $uri, $matches)) {
            $this->extractRouteParams($matches, $routeParams);
            return true;
        }

        return false;
    }

    protected function extractRouteParams($matches, &$routeParams): bool
    {
        // Remove the full match from the matches array
        unset($matches[0]);

        // Store named parameters in the $routeParams array
        $routeParams = $matches;

        // Return true if named parameters are present, false otherwise
        return !empty($routeParams);
    }

}
