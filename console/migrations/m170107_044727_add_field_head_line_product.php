<?php

use yii\db\Migration;

class m170107_044727_add_field_head_line_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'head_line', 'text CHARACTER SET utf8 COLLATE utf8_unicode_ci');
    }

    public function down()
    {
        echo "m170107_044727_add_field_head_line_product cannot be reverted.\n";

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
