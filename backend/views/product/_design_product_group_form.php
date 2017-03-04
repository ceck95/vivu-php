<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 12/25/16
 * Time: 8:32 AM
 */

use common\core\web\mvc\form\BaseActiveForm;
use common\models\DesignProductGroup;

/**
 * @var $this \common\core\web\mvc\View
 * @var $designProductGroup DesignProductGroup
 * @var $form BaseActiveForm
 */

?>

<?= $form->field($designProductGroup, 'name'); ?>
<?= $form->field($designProductGroup, 'priority'); ?>
