<?php

use yii\db\Schema;
use yii\db\Migration;

class m150914_061620_create_party_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('party', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'website' => $this->string()->notNull(),
            'content' => $this->text(),
            'content_ru' => $this->text(),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_party_name', 'party', 'name');
        $this->createIndex('idx_party_name_ru', 'party', 'name_ru');
    }

    public function down()
    {
        $this->dropTable('party');
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
