<script type="text/javascript">
    //<![CDATA[
    
    $(document).ready(function() {
    
            $('#createTransaction').click(function(){
                
                
                jQuery.ajax({
                    'type':'POST',
                    'url':'http://localhost/~mnouh/mozi/index.php?r=transaction/create',
                    'cache':false,
                    'data':$("form").serialize(),
                    'success':
                        function(html){
                        $('div.items').prepend(html);
                        $("textarea#description").val('');
                        $("input").val('');
                        
                    }});
                
                
                });
        
        });

        
    
    
    
   
</script>


<div class="container-fluid">
        <div class="row-fluid">
          <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
              <li class="nav-header">myMozi Interface</li>
              <li class="active"><a href="<?php echo Yii::app()->createUrl('user/home');?>"><i class="icon-chevron-right"></i> Dashboard</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('transaction/index');?>"><i class="icon-chevron-right"></i> View All Transactions</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/friends');?>"><i class="icon-chevron-right"></i> View All Friends</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/payment');?>"><i class="icon-chevron-right"></i> Add/Delete Credit Card</a></li>
               <li><a href="<?php echo Yii::app()->createUrl('user/bank');?>"><i class="icon-chevron-right"></i> Add/Delete Bank Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/account');?>"><i class="icon-chevron-right"></i> Manage Mozi Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('account/help');?>"><i class="icon-chevron-right"></i> Help</a></li>
            </ul>
          </div>
          
            
         <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>
      
            
       
           
          <div class="span5">
              <div class="row">
               <div class="span12">
                   
                   <div id="status">
                   <?php 
                   
                   $this->renderPartial('_pay', array('model' => $model), false, false);
                   ?>
                    </div>
              </div>
              
            <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>
              
   
            <div class="row">
              <div class="span12">
                  
                  
                 
         
            
              <h4><i class="icon-calendar"></i> Recent Transactions</h4>
              
              
              <div class="span12">
                  
                  
                  <?php
             
             
    $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_entry',   // refers to the partial view named '_post'
    'headerView'=>'_headerEntry',   // refers to the partial view named '_post'
    'pagerCssClass' => 'pagination',
        'pager'=>array(
            'htmlOptions' => array('class' => ''),
            'header' => '',
            'footer' => '',
            'prevPageLabel' => 'Prev',
            'nextPageLabel' => 'Next',
            'selectedPageCssClass' => 'active',
            
	),
    //'cssFile'=> Yii::app()->baseUrl.'/styles/css.css',
    'sortableAttributes'=>array(
        'recieverId',
        'amount'=>'Amount',
        //'' => CHtml::link('Clear Filters', array('user/'.$model->lookup.'?Reviews_page=pager')),
    ),
));
    
    
       ?>
                  
                  
                  
              </div>
              
                    </div>
             
             </div>
                </div>
 
                  
        
                  
                  <!--RIGHTHAND COLUMN-->
                  
                  <div class="span3">
                  
                  <div class="well span12" style="margin-left: 8px">
                      <div class="span4">
                      <img src="images/userprofileimg.jpg" alt="mozi" width="100" height="100"></div>
                      <div class="span8" style="padding-left: 6px">
        
                           <b><?php echo $user->firstName.' '.$user->lastName;?></b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> <?php echo $user->username;?>
                           
                           <h3 style="margin-top: 1px; margin-bottom:0px;">$151.36 <a href="#"><small>cash out</small></a></h3>
                       
                    
                       </div>
                      </div>
                  
                  <div class="well span12">
                    <h5 style="margin: 0px;">Friends on Mozi <small>(153)</small></h5>
                    <legend></legend>
                    
                    <div class="row" style="padding-bottom: 10px; padding-left:40px;">
                    
                    <div class="span2">
                      <img src="images/friend1.jpg" alt="mozi" width="50" height="50"></div>
                    <div class="span5" style="padding-left: 0px">
                           <b>Jack Hopkins</b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> jhopki103
                    </div>
                    <div class="span4">
                        <a href="#">send money</a>
                    </div>
                    </div>
                    
                    
                     <div class="row" style="padding-bottom: 10px; padding-left:40px;">
                     <div class="span2">
                      <img src="images/friend2.jpg" alt="mozi" width="50" height="50"></div>
                    <div class="span5" style="padding-left: 0px">
                           <b>Lucas Espinoza</b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> jhopki103
                    </div>
                    <div class="span4">
                        <a href="#">send money</a>
                    </div>
                     </div>
                    
                     <div class="row" style="padding-bottom: 10px; padding-left:40px;">
                     <div class="span2">
                      <img src="images/friend3.jpg" alt="mozi" width="50" height="50"></div>
                    <div class="span5" style="padding-left: 0px">
                           <b>MJ Lee</b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> jhopki103
                    </div>
                    <div class="span4">
                        <a href="#">send money</a>
                    </div>
                     </div>
                    
                     <div class="row" style="padding-bottom: 10px; padding-left:40px;">
                     <div class="span2">
                      <img src="images/friend4.jpg" alt="mozi" width="50" height="50"></div>
                    <div class="span5" style="padding-left: 0px">
                           <b>Erika Valdez</b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> jhopki103
                    </div>
                    <div class="span4">
                        <a href="#">send money</a>
                    </div>
                     </div>
                    
                  </div>
                  
                  
                  </div>
                  
        </div>
              
                
                  
</div>