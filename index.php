<?php

if(!defined('DS')){
	define('DS', DIRECTORY_SEPARATOR);
}

$webrootindex = dirname(__FILE__) . DS . 'web' . DS . 'app' . DS . 'webroot' . DS . 'index.php';
require $webrootindex;
