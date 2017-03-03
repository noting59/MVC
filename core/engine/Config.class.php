<?php

class Config
{

    protected static $aSettings = array();

    public static function Get($sKey){
        return isset(self::$aSettings[$sKey]) ? self::$aSettings[$sKey] : null;
    }

    public static function Set($sKey, $sValue){
        self::$aSettings[$sKey] = $sValue;
    }

}
