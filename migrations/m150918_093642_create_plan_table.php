<?php

use yii\db\Schema;
use yii\db\Migration;

class m150918_093642_create_plan_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('plan', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->string(1000),
            'content' => $this->text(),
            'image' => $this->string()->notNull(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_plan_title', 'plan', 'title');
        $this->createIndex('idx_plan_ru', 'plan', 'ru');
    }

    public function down()
    {
        $this->dropTable('plan');
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
