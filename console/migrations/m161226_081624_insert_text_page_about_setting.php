<?php

use yii\db\Migration;

class m161226_081624_insert_text_page_about_setting extends Migration
{
    public function up()
    {
        $this->insert('system_setting', [
            'key' => \common\modules\systemSetting\models\SystemSetting::KEY_TEXT_DESCRIPTION_OF_PAGE_ABOUT,
            'value' => 'This is text description',
            'type' => \common\modules\systemSetting\models\SystemSetting::TYPE_TECHNIQUE_SYSTEM,
            'explain' => 'This is text description'
        ]);
    }

    public function down()
    {
        echo "m161226_081624_insert_text_page_about_setting cannot be reverted.\n";

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
