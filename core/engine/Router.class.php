<?php

class Router extends EsObject
{
    protected $sUri;

    protected $sController;

    protected $sAction;

    protected $sParams;

    protected $sMethodPrefix;

    protected $sLang;

    protected static $oInstance = null;

    public static function getInstance(){
        if (isset(self::$oInstance) and (self::$oInstance instanceof self)) {
            return self::$oInstance;
        } else {
            self::$oInstance = new self();

            return self::$oInstance;
        }
    }

    public function __construct(){
    }

    public function Init(){
        $this->sUri = urlencode(trim($_SERVER['REQUEST_URI'], '/'));
        var_dump($this->sUri);
    }

    public function getUri(){
        return $this->sUri;
    }

    public function getController(){
        return $this->sController;
    }

    public function getAction(){
        return $this->sController;
    }

    public function getParams(){
        return $this->sParams;
    }

    public function getMethodPrefix(){
        return $this->sMethodPrefix;
    }

    public function getLang(){
        return $this->sLang;
    }
}
