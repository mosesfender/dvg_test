<?php

use yii\db\Migration;

class m170221_123451_dvg extends Migration
{
const TAB_NOTICE = "{{%Notice}}";
    public function up()
    {
        if ($this->db->driverName === "mysql") {
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }
        if ($this->db->schema->getTableSchema(self::TAB_NOTICE, true) === null) {
            $this->createTable(self::TAB_NOTICE, [
                "id" => $this->primaryKey(),
                "oncreate" => $this->timestamp()->defaultValue(NULL),
                "message" => $this->text()
            ]);
        }
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema(self::TAB_NOTICE, true) !== null) {
            $this->dropTable(self::TAB_NOTICE);
        }
    }

}
