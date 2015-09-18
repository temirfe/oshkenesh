<?php

use yii\db\Schema;
use yii\db\Migration;

class m150918_055915_create_gallery_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'main_img' => $this->string()->notNull(),
            'title' => $this->string(500)->notNull(),
            'title_ru' => $this->string(500)->notNull(),
            'description' => $this->string(1000)->notNull(),
            'description_ru' => $this->string(1000)->notNull(),
            'date' => $this->date(),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('gallery');
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
