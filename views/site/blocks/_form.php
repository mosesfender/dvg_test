<?php

use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use app\helpers\ParamsHelper;
use yii\helpers\Html;

/* @var $model \app\models\Notice  */

$form = ActiveForm::begin([
            "id" => "notice_form",
            "action" => "/site/create"
        ]);
echo $form->field($model, "id")->hiddenInput()->label(false);
echo $form->field($model, "message")->textarea();
echo $form->field($model, "oncreate")->hiddenInput()->label(false);
echo $form->field($model, "oncreate")->widget(DatePicker::className(), [
    'disabled' => true,
    "options" => [
    ],
    "pluginOptions" => [
        "autoclose" => true,
        "format" => ParamsHelper::DateFormat_JS()
    ],
    "removeButton" => false,
]);
echo Html::submitButton(Yii::t("app", "Create"), ["class" => "btn btn-primary btn-overlay pull-right"]);

ActiveForm::end();
