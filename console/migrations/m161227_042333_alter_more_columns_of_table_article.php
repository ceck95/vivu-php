<?php

use yii\db\Migration;

class m161227_042333_alter_more_columns_of_table_article extends Migration
{
    public function up()
    {
        $this->alterColumn('article', 'title', 'text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
        $this->alterColumn('article', 'url_key', 'text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');
        $this->alterColumn('article', 'content', 'text CHARACTER SET utf8 COLLATE utf8_unicode_ci');
        $this->alterColumn('article', 'meta_desc', 'text CHARACTER SET utf8 COLLATE utf8_unicode_ci');
    }

    public function down()
    {
        echo "m161227_042333_alter_more_columns_of_table_article cannot be reverted.\n";

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
