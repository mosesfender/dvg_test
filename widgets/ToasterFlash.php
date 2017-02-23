<?php

namespace app\widgets;

use odaialali\yii2toastr\Toastr;
use odaialali\yii2toastr\ToastrAsset;

class ToasterFlash extends \yii\bootstrap\Widget
{
    public $alertTypes = [
        'error'   => 'error',
        'danger'  => 'error',
        'success' => 'success',
        'info'    => 'info',
        'warning' => 'warning'
    ];
    
    public $options = [
        'closeButton' => true,
        'debug' => false,
        'newestOnTop' => true,
        'progressBar' => false,
        'positionClass' => 'toast-top-right',
        'preventDuplicates' => false,
        'onclick' => null,
        'showDuration' => '400',
        'hideDuration' => '1000',
        'timeOut' => '7000',
        'extendedTimeOut' => '1000',
        'showEasing' => 'swing',
        'hideEasing' => 'linear',
        'showMethod' => 'fadeIn',
        'hideMethod' => 'fadeOut'
    ];
    
    public function init()
    {
        parent::init();
        $view = $this->getView();
        ToastrAsset::register($view);
        
        $script = "
            window.showToast = function(type, message, title) {
                var func = toastr[type];
                if (typeof(message) == 'undefined') message = 'Internal error';
                
                if (typeof(func) == 'function') {
                    func(message, title, ".json_encode($this->options).");
                } else {
                    alert(type + '\\n' + message + '\\n' + title);
                }
            };
            
        ";
        $view->registerJs($script, $view::POS_READY);

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $message) {
                    $message = str_replace("\r", '', $message);
                    $message = str_replace("\n", '<br/>', $message);
                    $message = addcslashes($message, "'");
                    echo Toastr::widget([
                        'toastType' => $this->alertTypes[$type],
                        'message' => $message,
                        'options' => $this->options,
                        'customStyle' => false,
                    ]);
                }

                $session->removeFlash($type);
            }
        }
    }
}
