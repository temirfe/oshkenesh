<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_185617_addcol_link_image extends Migration
{
    public function up()
    {
        $this->addColumn('link','image','varchar(255) NULL');
    }

    public function down()
    {
        echo "m160102_185617_addcol_link_image cannot be reverted.\n";

        return false;
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
