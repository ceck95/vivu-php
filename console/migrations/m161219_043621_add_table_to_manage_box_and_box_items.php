<?php

use yii\db\Migration;

class m161219_043621_add_table_to_manage_box_and_box_items extends Migration
{
    public function init()
    {
        $tbl_boxs = \common\Factory::$app->db->schema->getTableSchema('boxs');
        $tbl_box_items = \common\Factory::$app->db->schema->getTableSchema('box_items');
        if ($tbl_box_items !== null){
            $this->dropTable('box_items');
        }
        if ($tbl_boxs !== null){
            $this->dropTable('boxs');
        }
        parent::init();
    }

    public function up()
    {
        /**
         * table boxs
         */
        $this->createTable('boxs', array_merge([
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'code' => $this->string()->notNull()->defaultValue(''),
            'name' => $this->string()->notNull()->defaultValue(''),
            'PRIMARY KEY (id)',
        ], $this->defaultColumn()));

        /**
         * table box_items
         */

        $this->createTable('box_items', array_merge([
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'box_id' => $this->integer(11)->unsigned(),
            'link' => $this->string()->null(),
            'text' => 'text',
            'priority' => $this->integer(11)->null(),
            'image' => $this->text(),
            'PRIMARY KEY (id)',
        ], $this->defaultColumn()));

        $this->addForeignKey('box_items_to_boxs_frk1', 'box_items', 'box_id', 'boxs', 'id');
    }

    public function down()
    {
        $this->dropTable('boxs');
        $this->dropTable('box_items');
        $this->dropForeignKey('box_items_ibfk_1', 'box_items');
    }
    private function defaultColumn()
    {
        return [
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer(11)->defaultValue(null)->unsigned(),
            'created_by' => $this->integer(11)->defaultValue(null)->unsigned(),
            'status' => $this->smallInteger(3)->defaultValue(1),
        ];
    }
}
