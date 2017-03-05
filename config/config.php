<?php

$config = array();

$config['path']['server']['root'] = dirname(__DIR__);

$config['path']['framework']['core']    = $config['path']['server']['root'] . '/core';
$config['path']['framework']['cache']    = $config['path']['server']['root'] . '/cache';
$config['path']['framework']['controllers']    = $config['path']['server']['root'] . '/controllers';

$config['lang'] = array('en', 'ru');

$config['default']['lang'] = 'en';
$config['default']['controller'] = 'ControllerIndex';
$config['default']['action'] = 'ActionIndex';

$config['routes']['default'] = 'ControllerIndex';
$config['routes']['admin'] = 'ControllerAdmin';

return $config;
