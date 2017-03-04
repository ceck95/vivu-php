<?php

use yii\db\Migration;

class m170108_022023_create_table_quote_and_quote_item extends Migration
{
    public function init()
    {
        $this->safeDropTable('customer');
        $this->safeDropTable('customer_address');
        $this->safeDropTable('quote');
        $this->safeDropTable('quote_item');
        $this->safeDropTable('quote_payment');
        $this->safeDropTable('sales_order');
        $this->safeDropTable('sales_order_item');
        $this->safeDropTable('sale_order_status_history');
        $this->safeDropTable('sales_order_payment');

        parent::init();
    }

    public function safeDropTable($name)
    {

        $tbl = \common\Factory::$app->db->schema->getTableSchema($name);
        if ($tbl !== null) {
            $this->dropTable($name);
        }

    }

    public function up()
    {

        /**
         * table customer
         */

        $this->createTable('customer', array_merge([
            'id' => $this->primaryKey(),
            'phone' => $this->text()->null(),
            'email' => $this->text()->null(),
            'full_name' => $this->text()->notNull(),
            'avatar' => $this->text()->null(),
            'dob' => $this->date()->notNull(),
            'gender' => $this->text()->notNull(),
            'password_hash' => $this->text()->notNull(),
            'password_reset_token' => $this->text()->null(),
            'auth_key' => $this->text()->null(),
        ], $this->defaultColumn()));

        /**
         * table customer_address
         */


        $this->createTable('customer_address', array_merge([
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(11)->null()->unsigned(),
            'type' => $this->text()->notNull(),
            'is_default' => $this->boolean()->notNull(),
            'full_name' => $this->text()->notNull(),
            'phone' => $this->text()->notNull(),
            'street' => $this->text()->notNull(),
            'city' => $this->text()->notNull(),
            'postal_code' => $this->integer(11)->notNull(),
            'state' => $this->text()->null(),
            'country_code' => $this->integer(11)->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('customer_address_to_customer_frk1', 'customer_address', 'customer_id', 'customer', 'id');

        /**
         * table quote
         */

        $this->createTable('quote', array_merge([
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->null()->unsigned(),
            'subtotal' => $this->integer(11)->null(),
            'grand_total' => $this->integer(11)->null(),
            'checkout_method' => $this->text()->null(),
            'customer_id' => $this->integer(11)->null()->unsigned(),
            'customer_address_id' => $this->integer(11)->null()->unsigned()
        ], $this->defaultColumn()));

        $this->addForeignKey('quote_to_customer_frk1', 'quote', 'customer_id', 'customer', 'id');
        $this->addForeignKey('quote_to_customer_address_frk1', 'quote', 'customer_address_id', 'customer_address', 'id');
        //vi chua tao table sale_order nen ko the them frk se update ở migrate sau nhé.
        /*$this->addForeignKey('quote_to_order_frk1', 'quote', 'order_id', 'sales_order', 'id');*/


        /**
         * table quote_item
         */

        $this->createTable('quote_item', array_merge([
            'id' => $this->primaryKey(),
            'quote_id' => $this->integer(11)->notNull()->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            'selected_product_color_id' => $this->integer(11)->notNull()->unsigned(),
            'designed_product_id' => $this->integer(11)->null()->unsigned(),
            'qty' => $this->integer(11)->notNull(),
            'base_price' => $this->integer(11)->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('quote_item_to_quote_frk1', 'quote_item', 'quote_id', 'quote', 'id');
        $this->addForeignKey('quote_item_to_product_frk1', 'quote_item', 'product_id', 'product', 'id');
        $this->addForeignKey('quote_item_to_product_color_frk1', 'quote_item', 'selected_product_color_id', 'product_color', 'id');
        $this->addForeignKey('quote_item_to_designed_product_frk1', 'quote_item', 'designed_product_id', 'designed_product', 'id');


        /**
         * table quote_payment
         */

        $this->createTable('quote_payment', array_merge([
            'id' => $this->primaryKey(),
            'quote_id' => $this->integer(11)->notNull()->unsigned(),
            'method' => $this->text()->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('quote_payment_to_quote_frk1', 'quote_payment', 'quote_id', 'quote', 'id');

        /**
         * table sales_order
         */

        $this->createTable('sales_order', array_merge([
            'id' => $this->primaryKey(),
            'order_status' => $this->text()->notNull(),
            'customer_id' => $this->integer(11)->notNull()->unsigned(),
            'customer_full_name' => $this->text()->notNull(),
            'customer_phone' => $this->text()->notNull(),
            'quote_id' => $this->integer(11)->notNull()->unsigned(),
            'shipping_address_id' => $this->integer(11)->notNull()->unsigned(),
            'shipping_amount' => $this->integer(11)->notNull(),
            'subtotal' => $this->integer(11)->notNull(),
            'grand_total' => $this->integer(11)->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('sales_order_to_customer_frk1', 'sales_order', 'customer_id', 'customer', 'id');
        $this->addForeignKey('sales_order_to_quote_frk1', 'sales_order', 'quote_id', 'quote', 'id');
        $this->addForeignKey('sales_order_to_customer_address_frk1', 'sales_order', 'shipping_address_id', 'customer_address', 'id');


        /**
         * table sales_order_item
         */

        $this->createTable('sales_order_item', array_merge([
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull()->unsigned(),
            'quote_item_id' => $this->integer(11)->notNull()->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            'selected_product_color_id' => $this->integer(11)->notNull()->unsigned(),
            'designed_product_id' => $this->integer(11)->notNull()->unsigned(),
            'qty' => $this->integer(11)->notNull(),
            'base_price' => $this->integer(11)->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('sales_order_item_to_order_frk1', 'sales_order_item', 'order_id', 'sales_order', 'id');
        $this->addForeignKey('sales_order_item_to_quote_item_frk1', 'sales_order_item', 'quote_item_id', 'quote_item', 'id');
        $this->addForeignKey('sales_order_item_to_product_frk1', 'sales_order_item', 'product_id', 'product', 'id');
        $this->addForeignKey('sales_order_item_to_product_color_frk1', 'sales_order_item', 'selected_product_color_id', 'product_color', 'id');
        $this->addForeignKey('sales_order_item_to_designed_product_frk1', 'sales_order_item', 'designed_product_id', 'designed_product', 'id');

        /**
         * table sale_order_status_history
         */

        $this->createTable('sale_order_status_history', array_merge([
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull()->unsigned(),
            'order_status' => $this->integer(11)->notNull(),
            'is_visible_for_customer' => $this->boolean()->notNull(),
            'comment' => $this->text()->null()
        ], $this->defaultColumn()));

        $this->addForeignKey('sale_order_status_history_to_order_frk1', 'sale_order_status_history', 'order_id', 'sales_order', 'id');

        /**
         * table sales_order_payment
         */

        $this->createTable('sales_order_payment', array_merge([
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull()->unsigned(),
            'method' => $this->text()->notNull()
        ], $this->defaultColumn()));

        $this->addForeignKey('sales_order_payment_to_order_frk1', 'sales_order_payment', 'order_id', 'sales_order', 'id');

    }

    public function down()
    {
        echo "m170108_001215_migrate cannot be reverted.\n";

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
