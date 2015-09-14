<?php

use yii\db\Schema;
use yii\db\Migration;

class m150914_053937_create_deputy_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('deputy', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string()->notNull(),
            'party_id' => $this->integer()->notNull()->defaultValue(0),
            'content' => $this->text(),
            'image' => $this->string()->notNull(),
            'content_ru' => $this->text(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'listorder' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_deputy_title', 'deputy', 'fullname');
        $this->createIndex('idx_deputy_party_id', 'deputy', 'party_id');
    }

    public function down()
    {
        $this->dropTable('deputy');
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
