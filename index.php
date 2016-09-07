<?php
/**
 * Kate - a minimalist php framework
 *
 * @author Michael R Miller <msqueeg@gmail.com>
 *
 * @package index.php
 */

defined('DS')
	or define('DS', DIRECTORY_SEPERATOR);

defined('ROOT_DIR')
	or define('ROOT_DIR', dirname(__FILE__));
defined('APP_PATH')
	or define('APP_DIR', ROOT_DIR . DS . 'app' . DS));
defined('INC_PATH')
	or define('INC_PATH', ROOT_DIR . DS . 'app' . DS 'inc' . DS);

require_once(APP_PATH . 'autoload.php');

$site = new Site;

//add site-wide templating elements here

$site->addHeader( INC_PATH .'header.php');
$site->addFooter( INC_PATH .'footer.php');
$site->addPasswordInclude(INC_PATH .'auth.php');
$site->router();