<?php
/* *
* Kate - a micro php mvc framework
* author - Michael R Miller
* website - michael-miller.org
*
* */

// package classes/Site.php

class Site {
    private $header;
    private $footer;
    private $password_protection;
    public $routes = array();
    private $nav;
    private $helper;

    public function __construct() {
        $this->nav = new Nav;
        $this->helper = new Helper;
    }


    public function addPasswordInclude($include){
        $this->password_protection = $include;
    }
    public function addHeader($header) {
        $this->header = $header;
    }

    public function addFooter($footer) {
        $this->footer = $footer;
    }

    public function display($page) {
        $Helper = $this->helper;
        include $this->header;
        if($page->needPass()){
            include $this->password_protection;
        } else {
            $page->display();
        }
        include $this->footer;
    }

    public function router(){
        global $app_folder;
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url,'/');
            $url = explode('/',$url);
            foreach($url as $key => $value) {
                $this->routes[$key] = $value;
            }
        } else {
            //echo $_SERVER['REQUEST_URI'];
            //echo $_GET['url'];
        }
        //echo $this->routes['0'];
        require_once $app_folder.'controllers'.DS.'root.php';
        $root = new root();

        //require_once "app".DS."controllers".DS."root.php";
        
        if(isset($this->routes['0'])) {
            $existing_pages = $this->nav->getPageArray();
            $alpha = $this->routes['0'];
            if(array_key_exists($alpha, $existing_pages)) {
                $next = $this->nav->getNext($alpha);
                $root->main($alpha, $next);
            } else {
                $folder = $app_folder.'views'.DS.$alpha;
                if(is_dir($folder)){
                    if(isset($this->routes['1'])){
                        $beta = $this->routes['1'];
                        $child_page = $folder.DS.$beta.'.php';
                    } else {
                        $child_page = $folder.DS.'index.php';
                    }
                    $root->main($child_page);
                } else{
                    $root->error();
                }
            }
        } else {
            $root->home();
        }
    }



}

?>