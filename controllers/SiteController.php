<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Notice;
use app\models\NoticeSearch;
use app\helpers\ParamsHelper;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class SiteController extends Controller {

    public function behaviors() {
        return [
            "verbs" => [
                "class" => VerbFilter::className(),
                "actions" => [
                    "create" => ["get", "post"],
                    "delete" => ["post"],
                    "list" => ["get", "post"],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render("notices");
    }

    public function actionNotices() {
        return $this->render("notices");
    }

    public function actionReadme() {
        return $this->render("readme");
    }

    public function actionCreate() {
        $model = new Notice();
        if (Yii::$app->request->isGet) {
            $model->oncreate = ParamsHelper::RandomDate(true);
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax("blocks/_form", ["model" => $model]);
            } else {
                return $this->render("blocks/_form", ["model" => $model]);
            }
        } elseif (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $ret = $model->insert();
                if ($ret) {
                    die(json_encode([
                        "error" => false, 
                        "month" => date("m.Y", strtotime($model->oncreate)), 
                        "message" => Yii::t("app", "Message «<i>{text}</i>» created at <i>{date}</i> with ID <i>{id}</i>", [
                            "text" => \yii\helpers\StringHelper::truncate($model->message, 60, "..."),
                            "date" => date(ParamsHelper::DateFormat_PHP(), strtotime($model->oncreate)),
                            "id" => $model->primaryKey
                    ])]));
                } else {
                    die(json_encode(["error" => true, "message" => Yii::t("app", "Cannot create new message")]));
                }
            }
        }
    }

    public function actionList() {
        $model = new NoticeSearch();
        $post = Yii::$app->request->queryParams;
        if (!isset($post["currentMonth"]) || $post["currentMonth"] == "")
            $post["currentMonth"] = $model->minMonth();
        $dataProvider = $model->search($post);
        return $this->renderAjax("blocks/_list", [
                    "model" => $model,
                    "dataProvider" => $dataProvider,
                    "pages" => $model->months(),
                    "queryParams" => $post
        ]);
    }

    public function actionDelete() {
        $model = new Notice();
        $res = $model->findOne(Yii::$app->request->post("id"));
        if ($res) {
            $ret = $res->delete();
            if (!is_null($ret)) {
                die(json_encode([
                    "error" => false,
                    "id" => Yii::$app->request->post("id"),
                    "message" => Yii::t("app", "Message with ID <i>{id}</i> has deleted.", ["id" => Yii::$app->request->post("id")]),
                ]));
            } else {
                die(json_encode([
                    "error" => true,
                    "message" => Yii::t("app", "Message with ID <i>{id}</i> cannot delete.", ["id" => Yii::$app->request->post("id")]),
                ]));
            }
        }else{
                die(json_encode([
                    "error" => true,
                    "message" => Yii::t("app", "Message with ID <i>{id}</i> not available.", ["id" => Yii::$app->request->post("id")]),
                ]));
        }
    }

}
