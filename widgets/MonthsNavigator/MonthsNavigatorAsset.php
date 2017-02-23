<?php

namespace app\widgets\MonthsNavigator;

use yii\web\AssetBundle;
use yii\web\View;

class MonthsNavigatorAsset extends AssetBundle {

    public $sourcePath = "";
    public $css = [
        "style.css"
    ];
    public $js = [
        "mn.js"
    ];
    public $publishOptions = [
        "forceCopy" => false,
    ];

    public function init() {
        parent::init();
        $this->sourcePath = __DIR__ . "/assets/";
    }

}
