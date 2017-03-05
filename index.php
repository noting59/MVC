<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

ini_set('display_errors', true);
error_reporting(E_ALL & ~(E_DEPRECATED|E_STRICT));

header('Content-Type: text/html; charset=utf-8');

require_once(ROOT.DS.'bootstrap.php');

try {
    $oRouter = Router::getInstance();
    $oRouter->Init('sdsdsds');
} catch (Exception $e) {
    $sProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
    header($sProtocol . " 500 Internal Server Error");
}
