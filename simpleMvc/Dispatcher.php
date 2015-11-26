<?php
namespace SimpleMvc;

class Dispatcher
{
    private $routes = [];

    public function LoadSections() {
        $sectionConfigFiles = $this->FindSectionConfigurations();

        foreach($sectionConfigFiles as $sectionConfigFile) {
            // Section config defines $routes
            require($sectionConfigFile);

            foreach($routes as $route) {
                $route['_rootPath'] = dirname($sectionConfigFile);

                $this->routes[] = $route;
            }
        }
    }

    public function Dispatch() {
        $route = $this->FindMatchingRoute($_GET['route']);

        if($route != null) {
            $this->RunRoute($route);
        }
    }

    private function RunRoute($route) {
        $controller = $route['controller'];
        $action = $route['action'];

        require($route['_rootPath'] . '/' . $controller . '.php');

        $controllerInstance = new $controller();
        $controllerInstance->SetRootPath($route['_rootPath']);
        $output = $controllerInstance->$action();

        echo $output;
    }

    private function FindMatchingRoute($requestedRoute) {
        foreach($this->routes as $definedRoute) {
            $regex = $this->BuildRouteRegex($definedRoute);

            if(preg_match($regex, $requestedRoute)) {
                return $definedRoute;
            }
        }

        return null;
    }

    private function BuildRouteRegex($route) {
        return '/^' . $route['path'] . '$/i';
    }

    private function FindSectionConfigurations() {
        $configurableSections = [];

        $sectionsRootPath = APP_ROOT_PATH . '/sections';
        $sectionsContent = scandir($sectionsRootPath);

        foreach($sectionsContent as $entry) {
            $sectionPath = $sectionsRootPath . '/' . $entry;
            $sectionConfigPath = $sectionPath . '/config.php';

            if(is_dir($sectionsRootPath . '/' . $entry) && is_file($sectionConfigPath)) {
                $configurableSections[] = $sectionConfigPath;
            }
        }

        return $configurableSections;
    }
}