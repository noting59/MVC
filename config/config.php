<?php

$config = array();

$config['path']['server']['root'] = dirname(__DIR__);

$config['path']['framework']['core']    = '___path.server.root___/core';
$config['path']['framework']['cache']    = '___path.server.root___/cache';
$config['path']['framework']['controllers']    = '___path.server.root___/controllers';

return $config;
