<?php

use yii\db\Migration;

class m161205_051940_add_session_db_table extends Migration
{
    public function up()
    {
        $this->createTable('session', [
            'id' => 'CHAR(40) NOT NULL PRIMARY KEY',
            'expire' => 'INTEGER',
            'data' => 'blob',
        ]);
    }

    public function down()
    {
        $this->dropTable('session');
    }

}
