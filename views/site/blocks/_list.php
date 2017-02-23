<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use app\widgets\MonthsNavigator\MonthsNavigator;

Pjax::begin([
    "id" => "notice_list",
    "enablePushState" => false,
    "clientOptions" => [
        "method" => "POST"
    ]
]);
echo GridView::widget([
    "id" => "notice_grid",
    "dataProvider" => $dataProvider,
    //"filterModel" => $model,
    "columns" => [
        [
            "headerOptions" => ["style" => "width:10px", "class" => "text-right"],
            "contentOptions" => ["class" => "text-right"],
            "attribute" => "id",
        ],
        "message:ntext",
        [
            "headerOptions" => ["style" => "width: 30px;", "class" => "text-center"],
            "contentOptions" => ["class" => "text-center"],
            "attribute" => "oncreate",
            "content" => function ($model) {
        return Yii::$app->formatter->asDate($model["oncreate"]);
    }
        ], [
            "headerOptions" => ["style" => "width: 10px;"],
            "content" => function ($model) {
        return Html::a("<span class=\"glyphicon glyphicon-trash\"></span>", ["delete"], [
                    "title" => Yii::t("app", "Delete"),
                    "data-id" => $model["id"],
                    "data-toggle" => "modal",
                    "data-target" => "#notice_delete_confirm",
                    "data-action" => "/site/delete",
                    "type" => "button",
        ]);
    }
        ],
    ],
    "tableOptions" => [
        "class" => "table table-striped"
    ],
    "layout" => "{items}"
]);

echo MonthsNavigator::widget([
    "id" => "mn",
    "months" => $pages,
    "queryParams" => $queryParams,
    "widgetClass" => "paginator pos-vertical pos-fixed pos-left",
    "url" => "/site/list",
    "pjaxID" => "notice_list"
]);
Pjax::end();
