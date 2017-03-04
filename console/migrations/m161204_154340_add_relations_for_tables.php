<?php

use yii\db\Migration;

class m161204_154340_add_relations_for_tables extends Migration
{
    public function up()
    {
        $this->addForeignKey('product_ibfk_1', 'product', 'category_id', 'category', 'id');
        $this->addForeignKey('product_color_ibfk_1', 'product_color', 'product_id', 'product', 'id');
        $this->addForeignKey('product_color_preview_image_ibfk_1', 'product_color_preview_image', 'product_color_id', 'product_color', 'id');
        $this->addForeignKey('design_product_group_ibfk_1', 'design_product_group', 'product_id', 'product', 'id');
        $this->addForeignKey('design_product_detail_ibfk_1', 'design_product_detail', 'product_group_id', 'design_product_group', 'id');
        $this->addForeignKey('designed_product_ibfk_1', 'designed_product', 'product_id', 'product', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('product_ibfk_1', 'product');
        $this->dropForeignKey('product_color_ibfk_1', 'product_color');
        $this->dropForeignKey('product_color_preview_image_ibfk_1', 'product_color_preview_image');
        $this->dropForeignKey('design_product_group_ibfk_1', 'design_product_group');
        $this->dropForeignKey('design_product_detail_ibfk_1', 'design_product_detail');
        $this->dropForeignKey('designed_product_ibfk_1', 'designed_product');
        return true;
    }

}
