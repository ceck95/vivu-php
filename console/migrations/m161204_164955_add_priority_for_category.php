<?php

use yii\db\Migration;

class m161204_164955_add_priority_for_category extends Migration
{
    public function up()
    {
        $this->addColumn('category', 'priority', 'int(11) unsigned after name');
    }

    public function down()
    {
        $this->dropColumn('category', 'priority');
    }
    
}
