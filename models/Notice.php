<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\ParamsHelper;

/**
 * @property integer    $id
 * @property string     $oncreate
 * @property string     $message
 */
class Notice extends ActiveRecord {

    public static function tableName() {
        return "{{%Notice}}";
    }

    public static function getDb() {
        return Yii::$app->get("db_dvg");
    }

    public function rules() {
        return [
            [["message", "oncreate"], "required"],
            [["message"], "string"],
            [["message"], "string", "max" => 1000],
            [["oncreate"], "safe"]
        ];
    }

    public function attributeLabels() {
        return [
            "id" => Yii::t("app", "ID"),
            "message" => Yii::t("app", "Message"),
            "oncreate" => Yii::t("app", "Create at"),
        ];
    }

    public function load($data, $formName = null) {
        try {
            parent::load($data, $formName);
            $this->setAttribute("oncreate", date("Y-m-d H:i:s", strtotime($this->oncreate)));
            return true;
        } catch (\yii\base\Exception $e) {
            return false;
        }
    }

    public function months() {
        $qq = (new \yii\db\Query())
                ->select(["DATE_FORMAT(oncreate, '%m.%Y') AS month"])
                ->from(self::tableName())
                ->groupBy("month")
                ->orderBy("oncreate");
        return $qq->column(self::getDb());
    }

    public function minMonth() {
        $qq = (new \yii\db\Query())
                ->select(["DATE_FORMAT(MIN(oncreate), '%m.%Y') AS month"])
                ->from(self::tableName());
        return $qq->scalar(self::getDb());
    }

}
