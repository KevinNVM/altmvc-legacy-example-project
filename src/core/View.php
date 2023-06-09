<?php

define('VIEWS_PATH', dirname(__FILE__) . '/../app/Views/');
define('VIEWS_LAYOUT_PATH', dirname(__FILE__) . '/../app/Views/layouts/');
define('DEFAULT_LAYOUT_PATH', 'main');


/**
 * View class represents a view template for rendering HTML content.
 */
class View
{
    protected $view;
    protected $params;
    protected $layout;
    protected $title;

    /**
     * Constructor for the View class.
     *
     * @param string $view    The path to the view file.
     * @param array  $params  Optional parameters to pass to the view.
     * @param string $layout  Optional layout file to use.
     * @param string $title   Optional title for the view.
     */
    public function __construct($view, $params = array(), $layout = '', $title = '')
    {
        $this->view = $view;
        $this->params = $params;
        $this->layout = $layout;
        $this->title = $title;

        if (empty($this->title)) {
            $this->title = isset($_ENV["APP_NAME"]) ? (string) $_ENV["APP_NAME"] : '';
        }
    }

    /**
     * Factory method to create a new instance of the View class.
     *
     * @param string $view    The path to the view file.
     * @param array  $params  Optional parameters to pass to the view.
     * @param string $title   Optional title for the view.
     *
     * @return View  A new instance of the View class.
     */
    public static function make($view, $params = array(), $title = '')
    {
        return new self($view, $params, $title);
    }

    /**
     * Set the title for the view.
     *
     * @param string $title  The title for the view.
     *
     * @return View  A new instance of the View class with the updated title.
     */
    public function title($title)
    {
        return new self($this->view, $this->params, $this->layout, $title);
    }

    /**
     * Render the view and return the output as a string.
     *
     * @throws Exception  If the view file or layout file is not found.
     *
     * @return string  The rendered view output.
     */
    public function render()
    {
        $viewPath = VIEWS_PATH . $this->view . '.php';
        $layoutPath = VIEWS_LAYOUT_PATH . $this->layout . '.php';

        $viewString = '';
        $layoutString = '';

        if (!file_exists($viewPath)) {
            throw new Exception('ViewNotFoundException');
        }

        if (!empty($this->layout)) {
            if (!file_exists($layoutPath)) {
                throw new Exception('LayoutNotFoundException');
            } else {
                $layoutString = $this->getLayout($layoutPath);
            }
        }

        $viewString = $this->getView($viewPath);

        $output = '';
        if (!empty($this->layout)) {
            $output = str_replace(
                array('%%BODY%%', '%%TITLE%%'),
                array($viewString, $this->title),
                $layoutString
            );
        } else {
            $output = $viewString;
        }

        return $output;
    }

    /**
     * Set the layout for the view.
     *
     * @param string $layout  The layout file to use.
     *
     * @return View  A new instance of the View class with the updated layout.
     */
    public function withLayout($layout = DEFAULT_LAYOUT_PATH)
    {
        $this->layout = $layout;

        return new self($this->view, $this->params, $this->layout);
    }

    /**
     * Retrieve the content of the layout file.
     *
     * @param string $layoutPath  The path to the layout file.
     *
     * @return string  The content of the layout file.
     */
    private function getLayout($layoutPath)
    {
        ob_start();
        require($layoutPath);
        return ob_get_clean();
    }

    /**
     * Retrieve the content of the view file.
     *
     * @param string $viewPath  The path to the view file.
     *
     * @return string  The content of the view file.
     */
    private function getView($viewPath)
    {
        extract($this->params);
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }

    /**
     * Convert the view to a string by rendering it.
     *
     * @return string  The rendered view output as a string.
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (Exception $e) {
            return 'View\'s File Not Found';
        }
    }
}