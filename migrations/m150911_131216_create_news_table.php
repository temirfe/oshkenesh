<?php

use yii\db\Schema;
use yii\db\Migration;

class m150911_131216_create_news_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->string(1000),
            'content' => $this->text(),
            'image' => $this->string()->notNull(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_news_title', 'news', 'title');
        $this->createIndex('idx_news_ru', 'news', 'ru');
    }

    public function down()
    {
        $this->dropTable('news');
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
