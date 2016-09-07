<?php
/**
 * autoloader function
 */

function __autoload($class) {
	include APP_DIR . 'lib/' . $class . '.php';
}