<?php

use yii\db\Migration;

class m161226_085324_create_table_article extends Migration
{
    public function init()
    {
        $tbl = \common\Factory::$app->db->schema->getTableSchema('article');
        if ($tbl !== null){
            $this->dropTable('article');
        }
        parent::init();
    }
    public function up()
    {
        $this->createTable('article', array_merge([
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'title' => $this->text()->notNull(),
            'url_key' => $this->text()->notNull(),
            'meta_desc' => $this->text()->null(),
            'content' => $this->text(),
            'thumbnail_image' => $this->text(),
            'num_view' => $this->integer(11)->defaultValue(0),
            'PRIMARY KEY (id)',
        ], $this->defaultColumn()));
    }

    public function down()
    {
        echo "m161226_085324_create_table_article cannot be reverted.\n";

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
