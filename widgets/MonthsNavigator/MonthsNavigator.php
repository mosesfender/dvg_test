<?php

namespace app\widgets\MonthsNavigator;

use Yii;
use yii\base\Widget;
use app\widgets\MonthsNavigator\MonthsNavigatorAsset;
use yii\helpers\Html;

class MonthsNavigator extends Widget {

    public $widgetClass = "paginator";
    public $id = "";
    public $months = [];
    public $currentMonth = "";
    public $queryParams = "";
    public $url = "/";
    public $pjaxID = "";

    public function init() {
        $this->currentMonth = $this->queryParams["currentMonth"];
        if ($this->id === "") {
            $this->id = "months_navigator_" . time();
        }
        MonthsNavigatorAsset::register($this->getView());
        $this->InitJS();
    }

    public function run() {
        $getQuery = function($url, $qp, $month) {
            $ret = [$url, "currentMonth" => $month];
            foreach ($qp as $key => $val) {
                if ($key != "currentMonth")
                    $ret[$key] = $val;
            }
            return $ret;
        };
        $ret = "<div id=\"{$this->id}\" class=\"{$this->widgetClass}\">";
        $ret .= "<div class=\"prev\"><span class=\"fa fa-caret-down fa-2x\"></span></div>";
        $ret .= "<div class=\"next\"><span class=\"fa fa-caret-up fa-2x\"></span></div>";
        $ret .= "<div class=\"inner\">";
        $ret .= "<ul>";
        foreach ($this->months as $month) {
            $class = $month == $this->currentMonth ? "active" : "";
            $ret.="<li class=\"{$class}\">";
            $ret .= Html::a($month, $getQuery($this->url, $this->queryParams, $month), ["data-method" => "POST",
                        "data-pjax" => "#{$this->pjaxID}"]);
            $ret .= "</li>";
        }
        $ret.= "</ul>";
        $ret.= "</div>";
        $ret.= "</div>";
        return $ret;
    }

    protected function InitJS() {
        $js = "var {$this->id} = new MonthsNavigator(document.getElementById('{$this->id}'));";
        $this->getView()->registerJs($js, \yii\web\View::POS_READY);
    }

}
