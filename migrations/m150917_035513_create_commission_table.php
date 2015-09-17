<?php

use yii\db\Schema;
use yii\db\Migration;

class m150917_035513_create_commission_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('commission', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'description' => $this->text(),
            'description_ru' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_commission_title', 'commission', 'title');
        $this->createIndex('idx_commission_title_ru', 'commission', 'title_ru');
    }

    public function down()
    {
        $this->dropTable('commission');
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
