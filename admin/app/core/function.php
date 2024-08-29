<?php
class Func
{

    private $url;


    public function __construct()
    {
        if (isset($_REQUEST['url'])) {
            $this->url =  explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    function handleActive($name)
    {
        if (empty($this->url)) {
            $display = 'active';
        }
        if ($this->url[0] == $name) {
            $active = 'active';
        }

        return ['active' => $active, 'display' => $display];
    }

    function setRootPath()
    {
        // Config root folder
        $folder_root = 'phone-ecommerce-chat';

        define('FOLDER_ROOT','/'. $folder_root);
        define('SCRIPT_ROOT', 'http://localhost/'.$folder_root.'/admin/public');
        define('IMAGES_PATH', 'http://localhost/'.$folder_root.'/storages/public');
        define('URL_APP', 'http://localhost/'.$folder_root.'/admin');
    }
}
