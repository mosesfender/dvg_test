<?php

Yii::setAlias("@app", dirname(__DIR__));

$params = array_merge(
        require(__COMMON__ . "/config/params.php"), require(__COMMON__ . "/config/params-local.php"), require(__DIR__ . "/params.php"), require(__DIR__ . "/params-local.php")
);

$ret = [
    "id" => "ssv",
    "basePath" => "@app",
    "language" => "ru-RU",
    "bootstrap" => ["log"],
    "controllerNamespace" => "app\controllers",
    "modules" => [
//        'gridview' => [
//            'class' => '\kartik\grid\Module'
//        ],
//        'pub' => [
//            'class' => 'mosesfender\publication\Module',
//        ],
//        'redactor' => [
//            'class' => 'yii\redactor\RedactorModule',
//            'uploadDir' => '@webroot/path/to/uploadfolder',
//            'uploadUrl' => '@web/path/to/uploadfolder',
//            'imageAllowExtensions' => ['jpg', 'png', 'gif']
//        ],
    ],
    "components" => [
        "request" => [
            "csrfParam" => "_csrf-ssv",
        ],
        "user" => [
            "identityClass" => "common\models\User",
            "enableAutoLogin" => true,
            "identityCookie" => ["name" => "_identity-wds", "httpOnly" => true],
        ],
        "session" => [
            // this is the name of the session cookie used for login on the frontend
            "name" => "dvg",
        ],
        "log" => [
            "traceLevel" => YII_DEBUG ? 3 : 0,
            "targets" => [
                [
                    "class" => "yii\log\FileTarget",
                    "levels" => ["error", "warning"],
                ],
            ],
        ],
        "errorHandler" => [
            "errorAction" => "site/error",
        ],
        "urlManager" => [
            "enablePrettyUrl" => true,
            "showScriptName" => false,
            "rules" => [
            ],
        ],
    ],
    "params" => $params,
];

return $ret;
