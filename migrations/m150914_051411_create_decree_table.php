<?php

use yii\db\Schema;
use yii\db\Migration;

class m150914_051411_create_decree_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('decree', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->string(1000),
            'content' => $this->text(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'number' => $this->string(20)->notNull(),
            'session_id' => $this->integer()->notNull()->defaultValue(0),
            'word' => $this->string()->notNull(),
            'pdf' => $this->string()->notNull(),
            'word_size' => $this->string(20)->notNull(),
            'pdf_size' => $this->string(20)->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_decree_title', 'decree', 'title');
        $this->createIndex('idx_decree_ru', 'decree', 'ru');
    }

    public function down()
    {
        $this->dropTable('decree');
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
