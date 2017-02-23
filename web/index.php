<?php

defined("__FW__") or define("__FW__", realpath("../../../framework"));
defined("__COMMON__") or define("__COMMON__", realpath("../../../common"));
defined("__SITES__") or define("__SITES__", realpath("../.."));
defined("YII_DEBUG") or define("YII_DEBUG", true);
defined("YII_ENV") or define("YII_ENV", "dev");

require(__FW__ . "/vendor/autoload.php");
require(__FW__ . "/vendor/yiisoft/yii2/Yii.php");
require(__COMMON__ . "/config/bootstrap.php");
//require(__DIR__ . "/../config/bootstrap.php");

$config = yii\helpers\ArrayHelper::merge(
    require(__COMMON__ . "/config/main.php"), 
    require(__COMMON__ . "/config/main-local.php"), 
    require(__DIR__ . "/../config/main.php"), 
    require(__DIR__ . "/../config/main-local.php")
);
//prer($config,0,1);
//prer(\yii::$aliases,0,1);
$application = new yii\web\Application($config);
$application->run();
