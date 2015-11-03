<style>
    #transport-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
    .ui.message.warning {
        border: 1px dashed;
    }
</style>
<?php
$this->layout = "//layouts/column2_sms";
$this->renderPartial('//sms/default/_menu', array('active' => 'sms'));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sms-out-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
</div><!-- search-form -->
<div style="float: left;width:420px;">
    <h3 class="ui header dividing " style="margin-top: 0">SMS Report Department Wise</h3>
<table class="ui table segment view-table">
    <tbody>
        <?php
        $total = 0;
        $grand_total = 0;
        $i = 0;
        
        foreach ($tasksByDept as $task) {
            

        ?>    
        
                <?php
                
               $date = new DateTime($task['create_time']);
            if ($tmp != $date->format('F,Y')) {
                if($total)
                {
                    echo "</tbody>";
                    echo "</table>";
                    
                    
                    echo "<table class='ui table segment view-table'>";
                    echo "<tbody>";
                
                }
                ?>
        <tr>
            <th colspan="" class="even" style="background: #DDD">
                <?php
                
                echo "<h3 style='margin:0'>" . $date->format('F, Y')." </h3>";


                
        ?> 
                
            </th>        
            <th>
                <span id=totalD_<?php echo $i;?> </span>
                <?php
                if ($total) {
                    ?>

                <script>
                    document.getElementById('totalD_<?php echo $i - 1; ?>').innerHTML = '<?php echo $total; ?>';
                </script>
                <?php
                $total = 0;
            }
            $i++;
        }
        ?>
            </th>
        </tr>

        <tr class="even">
            <th>              
                <?php
                
                
                    echo $task['department'];
                
                
                
                ?>
            </th>
            
            <td>
                <?php echo $task['sms_count']; ?>                 
            </td>
        </tr>



        <?php
        $total+=$task['sms_count'];
        $grand_total += $task['sms_count'];

        $tmp = $date->format('F,Y');
    }
    ?>
</tbody>
</table>
<table class="ui table segment view-table">
    <tbody>
    <th>
        Grand Total
    </th>
    <th><?php echo $grand_total; ?></th>
        
    </tbody>
</table>
<script>
    document.getElementById('totalD_<?php echo $i - 1; ?>').innerHTML = '<?php echo $total; ?>';
</script>

</div>
<div style="float:right;width:420px;">
    <h3 class="ui header dividing " style="margin-top: 0">SMS Report Group/App Wise</h3>
<table class="ui table segment view-table" >
    <tbody>
        <?php
        $total = 0;
        $grand_total = 0;
        $i = 0;
        foreach ($tasks as $task) {
            

        ?>    
        
                <?php
                
               $date = new DateTime($task['create_time']);
            if ($tmp != $date->format('F,Y')) {
                if($total)
                {
                    echo "</tbody>";
                    echo "</table>";
                    
                    
                    echo "<table class='ui table segment view-table'>";
                    echo "<tbody>";
                
                }
                ?>
        <tr>
            <th colspan="" class="even" style="background: #DDD">
                <?php
                
                echo "<h3 style='margin:0'>" . $date->format('F, Y')." </h3>";


                
        ?> 
                
            </th>        
            <th>
                <span id=total_<?php echo $i;?> </span>
                <?php
                if ($total) {
                    ?>

                <script>
                    document.getElementById('total_<?php echo $i - 1; ?>').innerHTML = '<?php echo $total; ?>';
                </script>
                <?php
                $total = 0;
            }
            $i++;
        }
        ?>
            </th>
        </tr>

        <tr class="even">
            <th>              
                <?php
                if ($task['group_id'])
                {
                    echo SmsGroup::model()->findByPk($task['group_id'])->name;
                    echo " (".SmsGroup::model()->findByPk($task['group_id'])->department.")";
                }
                if ($task['app_id'])
                {
                    echo SmsApp::model()->findByPk($task['app_id'])->app_name;
                    echo " (".  SmsApp::model()->findByPk($task['app_id'])->department.")";
                }
                
                ?>
            </th>
            
            <td>
                <?php echo $task['sms_count']; ?>                 
            </td>
        </tr>



        <?php
        $total+=$task['sms_count'];
        $grand_total += $task['sms_count'];

        $tmp = $date->format('F,Y');
    }
    ?>
</tbody>
</table>
    
<table class="ui table segment view-table">
    <tbody>
    <th>
        Grand Total
    </th>
    <th><?php echo $grand_total; ?></th>
        
    </tbody>
</table>
<script>
    document.getElementById('total_<?php echo $i - 1; ?>').innerHTML = '<?php echo $total; ?>';
</script>

</div>




