<?php

use yii\db\Schema;
use yii\db\Migration;

class m150914_084149_create_page_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->string(1000),
            'content' => $this->text(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_page_title', 'page', 'title');
        $this->createIndex('idx_page_ru', 'page', 'ru');
    }

    public function down()
    {
        $this->dropTable('page');
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
