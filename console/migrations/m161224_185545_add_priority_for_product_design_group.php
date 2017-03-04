<?php

use yii\db\Migration;

class m161224_185545_add_priority_for_product_design_group extends Migration
{
    public function up()
    {
        $this->addColumn('design_product_group', 'priority', 'integer(11) unsigned after name');
    }

    public function down()
    {
        $this->dropColumn('design_product_group', 'priority');
    }

}
