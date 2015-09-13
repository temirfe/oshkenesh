<?php

use yii\db\Schema;
use yii\db\Migration;

class m150913_183419_create_legislation_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('legislation', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(500)->notNull(),
            'content' => $this->text(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_legislation_title', 'news', 'title');
        $this->createIndex('idx_legislation_ru', 'news', 'ru');
    }

    public function down()
    {
        $this->dropTable('legislation');
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
