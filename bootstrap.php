<?php
require_once(ROOT.DS.'core'.DS.'engine'.DS.'Config.class.php');

Config::LoadFromFile(ROOT.DS.'config'.DS.'config.php');


require_once(Config::Get('path.framework.core').'/engine/Engine.class.php');
