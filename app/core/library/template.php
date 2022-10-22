<?php
namespace DIAMOND\Core\Library;

class Template
{
    use TemplateHelper;

    private $_templateParts;
    private $_action_view;
    private $_data;
    private $_registry;

    public function __get($key)
    {
        return $this->_registry->$key;
    }
    public function __construct(array $parts)
    {
        $this->_templateParts = $parts;
    }
    public function setActionViewFile($actionViewPath)
    {
        $this->_action_view = $actionViewPath;
    }
    public function setAppData($data)
    {
        $this->_data = $data;
    }
    public function swapTemplate($template)
    {
        $this->_templateParts['template'] = $template;
    }
    public function setRegistry($registry)
    {
        $this->_registry = $registry;
    }

    private function headerstart()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'headerstart.php';
    }
    private function renderHeaderResources()
    {
        $output = '';
        if(!array_key_exists('header_resources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the header resources', E_USER_WARNING);
        } else {
            extract($this->_data);
            $output .= '<link rel="stylesheet" href="' . CSS . $Bootstrap . '" />';

            // Generate CSS Links
            $resources  = $this->_templateParts['header_resources'];
            $css        = $resources['css'];
            if(!empty($css)) {
                foreach ($css as $cssKey => $path) {
                    $output .= '<link rel="stylesheet" href="' . $path  . '" />';
                }
            }
            $output .= '<link rel="stylesheet" href="' . CSS . $LangCss . '" />';

            // Generate JS Scripts
            $js = $resources['js'];
            if(!empty($js)) {
                foreach ($js as $jsKey => $path) {
                    $output .= '<script src="' . $path . '"></script>';
                }
            }
        }
        echo $output;
    }
    private function headerend()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'headerend.php';
    }
    private function renderTemplateBlocks()
    {
        if(!array_key_exists('template', $this->_templateParts)) {
            trigger_error('Sorry you have to define the template blocks', E_USER_WARNING);
        } else {
            $parts = $this->_templateParts['template'];
            if(!empty($parts)) {
                extract($this->_data);
                foreach ($parts as $partKey => $file) {
                    if($partKey === ':view') {
                        require_once $this->_action_view;
                    } else {
                        require_once $file;
                    }
                }
            }
        }
    }
    private function footerstart()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'footerstart.php';
    }
    private function renderFooterResources()
    {
        $output = '';
        if(!array_key_exists('footer_resources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the footer resources', E_USER_WARNING);
        } else {
            $resources = $this->_templateParts['footer_resources'];
            // Generate JS Scripts
            if(!empty($resources)) {
                foreach ($resources as $resourceKey => $path) {
                    $output .= '<script src="' . $path . '"></script>';
                }
            }
        }
        echo $output;
    }
    private function footerend()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'footerend.php';
    }

    public function renderApp()
    {
        $this->headerstart();
        $this->renderHeaderResources();
        $this->headerend();
        $this->renderTemplateBlocks();

        $this->footerstart();
        $this->renderFooterResources();
        $this->footerend();
    }
}