<?php

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);

require_once 'EsObject.class.php';

require_once 'Router.class.php';


class Engine extends EsObject
{

    protected static $oInstance = null;

    protected function __construct(){
    }

    protected function __clone(){
    }

    public static function getInstance(){
        if (isset(self::$oInstance) and (self::$oInstance instanceof self)) {
            return self::$oInstance;
        } else {
            self::$oInstance = new self();

            return self::$oInstance;
        }
    }

    public static function autoload($sClassName){
        $sControllerPath = ROOT.DS.'controllers'.DS.'Controller'.$sClassName.'.class.php';
        $sModulePath = ROOT.DS.'core'.DS.'module'.DS.'Module'.$sClassName.'.class.php';

        if(file_exists($sControllerPath)){
            require_once($sControllerPath);
        } elseif (file_exists($sModulePath)) {
            require_once($sModulePath);
        } else {
            throw new Exception("Failed to load class: ".$sClassName , 1);
        }
    }
}

spl_autoload_register(array('Engine', 'autoload'));
