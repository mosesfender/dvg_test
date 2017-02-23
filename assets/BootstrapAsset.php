<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle {

    public $sourcePath = '@bower/bootstrap';
    public $js = [
        'js/moment-with-locales.js',
        'js/datetimepicker.js',
    ];
    public $css = [
        'dist/css/datetimepicker.css'
    ];

}
