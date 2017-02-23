<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\BootstrapAsset;
use app\assets\LocalAsset;
use common\components\FontAwesomeAsset;
use app\widgets\ToasterFlash;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

AppAsset::register($this);
BootstrapAsset::register($this);
LocalAsset::register($this);
FontAwesomeAsset::register($this);
//app\widgets\MonthsNavigator\MonthsNavigatorAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top'
            ],
        ]);
        echo Nav::widget([
            "options" => [
                "class" => "navbar-nav navbar-left"
            ],
            "items" => [
                ["label" => Yii::t("app", "Notices"), "url" => ["/site/notices"]]
            ]
        ]);
        ?>
        <button class="btn btn-success pull-right btn-navigate btn-read-task">
            <span class="fa fa-briefcase fa-fw"></span>&nbsp;<?php echo Yii::t("app", "Read task"); ?>
        </button>
        <button class="btn btn-primary pull-right btn-navigate btn-add-message">
            <span class="fa fa-plus-square-o fa-fw"></span>&nbsp;<?php echo Yii::t("app", "Add message"); ?>
        </button>
            <?php
        NavBar::end();
        ?>
        <div class="wrap">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
        <?php echo ToasterFlash::widget(); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
