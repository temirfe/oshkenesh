<?php

use yii\db\Schema;
use yii\db\Migration;

class m151221_200656_create_link_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'title' => $this->string(500)->notNull(),
            'title_ru' => $this->string(500)->notNull(),
            'priority' => $this->integer(3),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m151221_200656_create_link_table cannot be reverted.\n";

        return false;
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
