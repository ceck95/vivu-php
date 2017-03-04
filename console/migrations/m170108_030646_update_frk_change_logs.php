<?php

use yii\db\Migration;

class m170108_030646_update_frk_change_logs extends Migration
{
    public function up()
    {
        $this->addForeignKey('quote_to_order_frk1', 'quote', 'order_id', 'sales_order', 'id');
    }

    public function down()
    {
        echo "m170108_030646_update_frk_change_logs cannot be reverted.\n";

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
