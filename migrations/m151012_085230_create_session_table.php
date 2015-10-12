<?php

use yii\db\Schema;
use yii\db\Migration;

class m151012_085230_create_session_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('session', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(),
            'description' => $this->string(1000),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('session');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
