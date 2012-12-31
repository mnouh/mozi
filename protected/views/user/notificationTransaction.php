
<script type="text/javascript">
    //<![CDATA[
    
    $(document).ready(function() {
             
                var transId = '<?php echo $model->id; ?>';
                
                
                jQuery.ajax({
                    'type':'POST',
                    'url':'http://localhost/~mnouh/mozi/index.php?r=transaction/showEntry',
                    'cache':false,
                    'data': {"transId": transId},
                    'success':
                        function(html){
                        $('div.items').prepend(html);
                        //$("textarea#description").val('');
                        //$("input").val('');
                        
                    }});
                

        
        
        });

        
    
    
    
   
</script>

<div class="alert" style="text-align: left;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Notification: There is a pending payment from @<?php echo $sender->username;?> with the amount <?php echo $model->amount;?>
</div>