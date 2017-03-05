<?php

class Config
{
    protected static $oInstance = null;
    protected $aConfig = array();

    public static function getInstance()
    {
        if (isset(self::$oInstance)) {
            return self::$oInstance;
        } else {
            self::$oInstance = new self();

            return self::$oInstance;
        }
    }
    
    protected function __construct()
    {
    }


    public static function LoadFromFile($sFile)
    {
        if (!file_exists($sFile)) {
            return false;
        }

        $aConfig = include $sFile;

        if (!is_array($aConfig)) {
            return false;
        }

        self::getInstance()->SetConfig($aConfig);

        return self::getInstance();
    }

    public function GetConfig()
    {
        return $this->aConfig;
    }

    public function SetConfig($aConfig = array())
    {
        if (is_array($aConfig)) {
            $this->aConfig = $this->ArrayEmerge($this->aConfig, $aConfig);
            return true;
        }
        $this->aConfig = array();

        return false;
    }

    public static function Get($sKey = '')
    {
        if ($sKey == '') {
            return self::getInstance()->GetConfig();
        }

        return self::getInstance()->GetValue($sKey);
    }

    public function GetValue($sKey)
    {
        // Return config by path (separator=".")
        $aKeys = explode('.', $sKey);

        $aConfig = $this->GetConfig();
        foreach ((array)$aKeys as $sKey) {
            if (isset($aConfig[$sKey])) {
                $aConfig = $aConfig[$sKey];
            } else {
                return;
            }
        }

        return $aConfig;
    }

    public static function isExist($sKey)
    {
        if ($sKey == '') {
            return (count((array) self::getInstance()->GetConfig()) > 0);
        }

        // Analyze config by path (separator=".")
        $aKeys = explode('.', $sKey);
        $cfg = self::getInstance()->GetConfig();
        foreach ((array) $aKeys as $sK) {
            if (array_key_exists($sK, $cfg)) {
                $cfg = $cfg[$sK];
            } else {
                return false;
            }
        }

        return true;
    }

    public static function Set($sKey, $value)
    {
        $aKeys = explode('.', $sKey);

        if (isset($value['$root$']) && is_array($value['$root$'])) {
            $aRoot = $value['$root$'];
            unset($value['$root$']);
            foreach ($aRoot as $sRk => $mRv) {
                self::Set(
                    $sRk,
                    self::isExist($sRk)
                        ? func_array_merge_assoc(self::Get($sRk), $mRv)
                        : $mRv
                );
            }
        }

        $sEval = 'self::getInstance()->aConfig';
        foreach ($aKeys as $sK) {
            $sEval .= '['.var_export((string) $sK, true).']';
        }
        $sEval .= '=$value;';
        eval($sEval);

        return true;
    }

    protected function ArrayEmerge($aArray1, $aArray1)
    {
        return $this->func_array_merge_assoc($aArray1, $aArray1);
    }

    protected function func_array_merge_assoc($aArray1, $aArray2)
    {
        $aResult = $aArray1;
        foreach ($aArray2 as $sKey2 => $sValue2) {
            $bIsKeyInt = false;
            if (is_array($sValue2)) {
                foreach ($sValue2 as $sKey => $sValue) {
                    if (is_int($sKey)) {
                        $bIsKeyInt = true;
                        break;
                    }
                }
            }
            if (is_array($sValue2) and !$bIsKeyInt and isset($aArray1[$sKey2])) {
                $aResult[$sKey2] = $this->func_array_merge_assoc($aArray1[$sKey2], $sValue2);
            } else {
                $aResult[$sKey2] = $sValue2;
            }
        }

        return $aResult;
    }
}
