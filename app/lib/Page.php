<?php
/* *
* Kate - a micro php mvc framework
* author - Michael R Miller
* website - michael-miller.org
*
* */

// package classes/Page.php

class Page {
    private $site;
    private $content;
    private $title;
    private $password = false;
    private $nav;
    private $page_list;

    public function __construct($site) {
        $this->nav = new Nav;
        $this->site = $site;
        $this->page_list = $this->nav->getPageArray();
    }

    public function addTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        echo $this->title;
    }

    public function addContent($current, $next) {
        if(array_key_exists($current,$this->page_list)) {
            $current_page = $this->page_list[$current];
        } else {
            $current_page = $current . '.php';
        }

        $this->title = $current;
        $link = $this->getLink($next);
        //$content_path = $this->app_folder . '/views/' . $current_page;
        ob_start();
        include ROOT_DIR . '/html/' . $current_page;
        $this->content = ob_get_clean();
    }

    public function display() {
        echo $this->content;
    }

    public function requirePass(){
        $this->password = true;
    }

    public function needPass(){
        return $this->password;
    }

    public function getlink($partial) {
        return $this->nav->getLink($partial);
    }
}

?>