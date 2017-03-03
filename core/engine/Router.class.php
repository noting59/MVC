<?php

class Router
{
    protected $sUri;

    protected $sController;

    protected $sAction;

    protected $sParams;

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

    public function Init($sUri){
        var_dump('Ok! Router was called with uri' . $sUri);
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
}
