<?php
/**
 * Kate - a micro php mvc framework
 * author - Michael R Miller
 * website - michael-miller.org
 */

// package classes/Nav.php

 class Nav {
    private $nav_list = array();
    private $view_dir;
    private $Helper;

    public function __construct() {
        global $parent;
        $this->view_dir = $parent.DS.'app'.DS.'views'.DS;
        $this->nav_list = $this->buildPageArray();
        $this->Helper = new Helper;
    }

    private function buildPageArray() {
        $first_array = array();
        $scan_array = array_diff(scandir($this->view_dir), array('..', '.', 'Error.php', 'Home.php'));
        foreach ($scan_array as $key => $value){
            $page_name = explode('.', $value);
            $first_array[$page_name['1']] = $value;
        }
        unset($page_name);
        unset($value);
        return $first_array;
    }

    public function getPageArray() {
        return $this->nav_list;
    }

    public function getNav() {
        $nav = '<ul>';
        $i = 1;
        foreach ($this->nav_list as $key => $value) {
            $nav .='<li class="nav-'.$i.'" ><a href="'.$this->Helper->url().$key.'">'.$key.'</a></li>';
            $i++;
        }
        $nav .= '</ul>';
        echo $nav;
    }

    public function getNext($current_key){
        $array_keys = array_keys($this->nav_list);
        $aIndices = array_flip($array_keys);
        $i = $aIndices[$current_key] + 1;
        $next = $array_keys[$i];
        return $next;
    }

    public function getLink($page = '') {
        return $this->Helper->url().$page;
    }

 }
?>