<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class LocalAsset extends AssetBundle {

    public $sourcePath = '@app/assets/site/';
    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/main.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
        'type' => 'text/javascript'
    ];
    public $depends = [
    ];
    public $publishOptions = [
        'forceCopy' => false,
    ];

}
