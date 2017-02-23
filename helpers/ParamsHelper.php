<?php

namespace app\helpers;

use Yii;

class ParamsHelper {

    public static function MinCreateDateTimestamp() {
        return strtotime(Yii::$app->params["min_create_date"]);
    }

    public static function MaxCreateDateTimestamp() {
        return strtotime(Yii::$app->params["max_create_date"]);
    }

    public static function DateFormat_PHP() {
        return Yii::$app->params["php_date_format"];
    }

    public static function DateFormat_JS() {
        return Yii::$app->params["js_date_format"];
    }

    public static function RandomDate($formatted = false){
        $ret = rand(self::MinCreateDateTimestamp(), self::MaxCreateDateTimestamp());
        if($formatted){
            $ret = date(self::DateFormat_PHP(), $ret);
        }
        return $ret;
    }
}
