<?php

use yii\db\Schema;
use yii\db\Migration;

class m150917_042115_create_feedback_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'from_name' => $this->string(100)->notNull(),
            'from_email' => $this->string(100)->notNull(),
            'date_create' => $this->date(),
            'date_answered' => $this->date(),
            'text' => $this->text(),
            'answer' => $this->text(),
            'to_parent' => $this->smallInteger()->notNull()->defaultValue(0),
            'to_child' => $this->smallInteger()->notNull()->defaultValue(0),
            'public' => $this->smallInteger(1)->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('feedback');
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
