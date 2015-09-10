<?php

use yii\db\Schema;
use yii\db\Migration;

class m150910_093756_create_university_table extends Migration
{
    public function up()
    {
        $this->createTable('university', [
            'id' => $this->primaryKey(),
            'graduate' => $this->integer('1')->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'state' => $this->string('20')->notNull(),
            'zip' => $this->string('20')->notNull(),
            'phone' => $this->string('20')->notNull(),
            'fax' => $this->string('20')->notNull(),
            'url' => $this->string('20')->notNull(),
            'president' => $this->string()->notNull(),
            'url_fin_aid' => $this->string()->notNull(),
            'url_admissions' => $this->string()->notNull(),
            'url_apply' => $this->string()->notNull(),
            'grad_rate' => $this->integer('2'),
            'grad_rate_men' => $this->integer('2'),
            'grad_rate_women' => $this->integer('2'),
            'apply_fee' => $this->integer(),
            'about' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('university');
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
