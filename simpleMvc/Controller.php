<?php
namespace SimpleMvc;

class Controller
{
    private $masterPagePath = '';
    private $rootPath = '';
    private $pageTitle = '';
    private $content = '';

    public function SetRootPath($path) {
        $this->rootPath = $path;
    }

    protected function SetPageTitle($title) {
        $this->pageTitle = $title;
    }

    protected function SetMasterPage($path) {
        $this->masterPagePath = APP_ROOT_PATH . '/' . $path;
    }

    protected function Render($view) {
        $viewPath = $this->rootPath . '/' . $view;

        // Capture view.
        ob_start();
        require($viewPath);
        $this->content = ob_get_clean();

        // Invoke master page.
        require($this->masterPagePath);
    }
}