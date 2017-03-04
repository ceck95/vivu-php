<?php

use yii\db\Migration;

class m161224_033510_alter_column_option_of_table_box_items extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('box_items');
        if(!isset($table->columns['option'])) {
            $this->addColumn('box_items', 'option', 'text default null');
        }else{
            $this->alterColumn('box_items', 'option', 'text default null');
        }
    }

    public function down()
    {
        echo "m161224_033510_alter_column_option_of_table_box_items cannot be reverted.\n";

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
