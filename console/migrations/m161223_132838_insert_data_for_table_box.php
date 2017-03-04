<?php

use yii\db\Migration;

class m161223_132838_insert_data_for_table_box extends Migration
{
    public function up()
    {
        $this->insert('boxs', [
            'code' => \common\models\Box::CODE_OF_INTRO_WELCOME_HOME_PAGE,
            'name' => 'Box Slide Show for Home Page'
        ]);
        $this->insert('boxs', [
            'code' => \common\models\Box::CODE_OF_NEW_FEED_HOME_PAGE,
            'name' => 'Box New Feed for HomePage'
        ]);
        $this->insert('boxs', [
            'code' => \common\models\Box::CODE_OF_PRODUCT_MODULE_HOME_PAGE,
            'name' => 'Box Product Module for Home Page '
        ]);
        $this->insert('boxs', [
            'code' => \common\models\Box::CODE_OF_INTRO_WELCOME_HOME_PAGE,
            'name' => 'Box Intro Welcome for Home Page'
        ]);
    }

    public function down()
    {
        echo "m161223_132838_insert_data_for_table_box cannot be reverted.\n";

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
