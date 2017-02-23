<?php
/* @var $this yii\web\View */

use kartik\dialog\Dialog;

echo Dialog::widget([
    "libName" => "krajeeDialogCust",
    "options" => [
        "size" => Dialog::SIZE_SMALL,
        "type" => Dialog::TYPE_WARNING,
        "title" => Yii::t("app", "Confirm delete"),
        "message" => Yii::t("app", "Are you sure remove this message?"),
    ]
]);
?>
<div class="row">
    <div class="col-md-12 list-container"></div>
</div>
<div class="form-container collapsed"></div>
<div class="task-container collapsed">
    <div class="inner">
<?php echo $this->renderFile("@app/views/site/readme.php"); ?>
    </div>
</div>