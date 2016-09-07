<?php
class Helper {
    public function url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $url = 'http://localhost/';

        if ($parse) {
            $url = parse_url($url);
            if (isset($url['path'])) if ($url['path'] == '/') $url['path'] = '';
        }

        return $url;
    }

    public function is_page(){
        $page_elems = explode('/',$_SERVER['REQUEST_URI']);
        return $page_elems[1];
    }

    public function format_style($path) {
        return '<link rel="stylesheet" href="'.$path.'" >';
    }

    public function format_script($path){
        return '<script type="text/javascript" src="'.$path.'"></script>';
    }

    public function load_cond_scripts($scripts=Array(), $css=FALSE){
        if(!empty($scripts)) {
            $o = '';
            foreach($scripts as $page => $urls){
                if(strpos($_SERVER['REQUEST_URI'], $page) !== false){
                    $o .= '<!-- '.$page.' '.($css == false ? 'javascript' : 'css').' files: -->';
                    foreach($urls as $url) {
                        if($css == FALSE) {
                            $o .= $this->format_script($url);
                        } else {
                            $o .= $this->format_style($url);
                        }
                    }
                }
            }
            return $o;
        }
    }
}
?>