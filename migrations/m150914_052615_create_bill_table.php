<?php

use yii\db\Schema;
use yii\db\Migration;

class m150914_052615_create_bill_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('bill', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->string(1000),
            'content' => $this->text(),
            'ru' => $this->smallInteger()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'number' => $this->string(20)->notNull(),
            'author' => $this->string()->notNull(),
            'word' => $this->string()->notNull(),
            'pdf' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_bill_title', 'bill', 'title');
        $this->createIndex('idx_bill_ru', 'bill', 'ru');
    }

    public function down()
    {
        $this->dropTable('bill');
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
