<?php

use yii\db\Migration;

class m161226_043026_create_table_contact extends Migration
{
    public function init()
    {
        $tbl = \common\Factory::$app->db->schema->getTableSchema('contact');
        if ($tbl !== null){
            $this->dropTable('contact');
        }
        parent::init();
    }
    public function up()
    {
        $this->createTable('contact', array_merge([
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'email' => $this->string(),
            'name' => $this->text(),
            'message' => $this->text(),
            'PRIMARY KEY (id)',
        ], $this->defaultColumn()));
    }

    public function down()
    {
        echo "m161226_043026_create_table_contact cannot be reverted.\n";

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
