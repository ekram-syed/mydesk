<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Update Item</h3>
<?php
$this->renderpartial('_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model'=>$model)); 
?>