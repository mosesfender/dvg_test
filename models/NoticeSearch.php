<?php

namespace app\models;

use Yii;
use app\models\Notice;
use yii\data\ActiveDataProvider;

class NoticeSearch extends Notice {

    public function rules() {
        return [];
    }

    public function search($query) {
        $date = explode(".", $query["currentMonth"]);
        $qq = Notice::find();
        $dataProvider = new ActiveDataProvider([
            "query" => $qq
        ]);
        $qq->andFilterWhere(['id' => $this->id]);
        $qq->andFilterWhere(["=", "YEAR(oncreate)", $date[1]])
                ->andFilterWhere(["=", "MONTH(oncreate)", $date[0]]);

        return $dataProvider;
    }
    
}
