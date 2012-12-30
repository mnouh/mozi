<div class="container-fluid">
        <div class="row-fluid">
          <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
              <li class="nav-header">myMozi Interface</li>
              <li class="active"><a href="<?php echo Yii::app()->createUrl('user/home');?>"><i class="icon-chevron-right"></i> Dashboard</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('transaction/index');?>"><i class="icon-chevron-right"></i> View All Transactions</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/friends');?>"><i class="icon-chevron-right"></i> View All Friends</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/payment');?>"><i class="icon-chevron-right"></i> Add/Delete Credit Card</a></li>
               <li><a href="<?php echo Yii::app()->createUrl('user/bank');?>l"><i class="icon-chevron-right"></i> Add/Delete Bank Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/account');?>"><i class="icon-chevron-right"></i> Manage Mozi Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('account/help');?>"><i class="icon-chevron-right"></i> Help</a></li>
            </ul>
          </div>
          
            
         <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>
      
            
      
           
          <div class="span5">
              <div class="row">
               <div class="span12">
                    <h3>Payment Hub</h3>
                 
                        <div class="input-append">
                     <button class="btn" type="button">Send</button>
                     <button class="btn" type="button">Request</button>
                     <input class="input-xlarge" id="appendedInputButtons" type="text" placeholder="Enter Mozi, @twitter name, e-mail, or phone # of user">
                 
                    </div>
                
                
                        <textarea cols="86" rows="2" placeholder="$10.50 for ..."></textarea>
             
                    
              
                        <button class="btn btn-info" type="button">Pay</button>
                  
              </div>
              </div>
              
            <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>
   
            <div class="row">
              <div class="span12">
         
            
              <h4><i class="icon-calendar"></i> Recent Transactions</h4>
              <table class="table table-hover">
                  <td><strong>#</strong></td>
                  <td><strong>Time</strong></td>
                  <td><strong>Friend</strong></td>
                  <td><strong>Notes</strong></td>
                  <td><strong>Amount</strong></td>
                  <td><strong>Status</strong></td>
                  
                  <tr class="warning">
                    <td>5817</td>
                    <td>3:32pm</td>
                    <td>Chris Paquette <small>@irunthisblock2</small></td>
                    <td>#xlargecombo</td>
                    <td>$19.36</td>
                    <td>Requested</td>
                  </tr>
                  <tr>
                    <td>5816</td>
                    <td>12:11pm</td>
                    <td>Mohamed Nouh <small>@mohamednouh</small></td>
                    <td>French Toast</td>
                    <td>-$13.86</td>
                    <td>Paid</td>
                  </tr>
                  <tr>
                    <td>5815</td>
                    <td>7:28am</td>
                    <td>Lucas Espinoza <small>@lespino</small></td>
                    <td>#xlargecombo</td>
                    <td>$19.36</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5814</td>
                    <td>Jan 1, 2013</td>
                    <td>George Murphy <small>@gmurphy19</small></td>
                    <td>CUSTOM</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
              </table>
                    </div>
             
             </div>
                </div>
 
                  
        
                  
                  <!--RIGHTHAND COLUMN-->
                  
                  <div class="span3">
                  
                  <div class="well span12" style="margin-left: 8px">
                      <div class="span4">
                      <img src="images/userprofileimg.jpg" alt="mozi" width="100" height="100"></div>
                      <div class="span8" style="padding-left: 6px">
        
                           <b><?php echo $model->firstName.' '.$model->lastName;?></b><br>
                           <img src="images/favicon.png" alt="mozi" width="15" height="15"> <?php echo $model->username;?>
                           
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