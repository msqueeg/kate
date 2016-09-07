<?php
/**
* Controller - a basic controller class
*
* Kate - a minimal php framework
*
* @author Michael R Miller <msqueeg@gmail.com>
*
* @package app/lib/Controller.php
*/

class Controller
{
	
	    function main($current,$next) {
        global $site;
        global $app_folder;

        $page = New Page($app_folder, $site);


        $page->addContent($current, $next);

        $site->display($page);
    }

    function home() {
        global $app_folder;
        global $site;

        $page = New Page($app_folder, $site);

        $page->addContent('Home','Sustainability');

        $site->display($page);
    }

    function error() {
        global $app_folder;
        global $site;

        $page = New Page($app_folder, $site);

        $page->addContent('Error', 'Home');

        $site->display($page);
    }

}
}