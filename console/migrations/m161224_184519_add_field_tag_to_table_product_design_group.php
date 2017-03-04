<?php

use yii\db\Migration;

class m161224_184519_add_field_tag_to_table_product_design_group extends Migration
{
    public function up()
    {
        $this->addColumn('design_product_detail', 'tag', 'string(255) after name');
    }

    public function down()
    {
        $this->dropColumn('design_product_detail', 'tag');
    }

}
