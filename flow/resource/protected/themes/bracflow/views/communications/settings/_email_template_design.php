<tr>
    <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Request Info:</font></td>
    <td>
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">
        <strong>Request Type: </strong> <?php echo $service; ?>,
        <strong> Requested Service/Package: </strong> <?php echo Settings::model()->findByPk($model->item_id)->item; ?>,
        <strong> Size:</strong> <?php echo $model->size; ?>,
        <strong> Color:</strong> <?php echo $model->color; ?>,
        <strong> Quantity:</strong> <?php echo $model->qty; ?>,
        <strong> Est. Delivery Date::</strong> <?php echo $model->est_delivery_date; ?>,

        </font><br/>
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><strong>Est. Total: </strong><?php echo $model->est_total; ?>  </font><br/>            
    </td>
</tr>

