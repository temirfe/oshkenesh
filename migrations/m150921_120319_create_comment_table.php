<?php

use yii\db\Schema;
use yii\db\Migration;

class m150921_120319_create_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'name' => $this->string(100),
            'content' => $this->string(1000),
            'user_id' => $this->integer()->notNull()->defaultValue(0),
            'model_name' => $this->string(100),
            'model_id' => $this->integer()->notNull()->defaultValue(0),
            'public' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_comment_modelid', 'comment', 'model_id');
        $this->createIndex('idx_comment_public', 'comment', 'public');
        $this->createIndex('idx_comment_modelname', 'comment', 'model_name');
    }

    public function down()
    {
        $this->dropTable('comment');
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
