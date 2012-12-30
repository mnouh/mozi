<div class="container-fluid">
        <div class="row-fluid">
          <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
              <li class="nav-header">myMozi Interface</li>
              <li><a href="<?php echo Yii::app()->createUrl('user/home');?>"><i class="icon-chevron-right"></i> Dashboard</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('transaction/index');?>"><i class="icon-chevron-right"></i> View All Transactions</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/friends');?>"><i class="icon-chevron-right"></i> View All Friends</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/payment');?>"><i class="icon-chevron-right"></i> Add/Delete Credit Card</a></li>
               <li><a href="<?php echo Yii::app()->createUrl('user/bank');?>"><i class="icon-chevron-right"></i> Add/Delete Bank Account</a></li>
              <li class="active"><a href="<?php echo Yii::app()->createUrl('user/account');?>"><i class="icon-chevron-right"></i> Manage Mozi Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('account/help');?>"><i class="icon-chevron-right"></i> Help</a></li>
            </ul>
          </div>
          
            
         <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>
            
            
         <!--Center Column-->
         
         <div class="span8">
            
                  <h3><i class="icon-wrench" style="position:relative; top: 7px; right: 0px"></i> Manage Account</h3> 
                 
             
             <ul class="nav nav-tabs">
  <li class="active">
    <a href="interface_account.html">Account Information</a>
  </li>
  <li><a href="interface_notifications.html">Notifications</a></li>

</ul>
           
            
            <div class='row'>
            <div class="span6">
              <dl class="dl-horizontal">
              <dt>First Name</dt>
              <dd>Christopher</dd>
              <dt>Last Name</dt>
              <dd>Paquette</dd>
              <dt>Mozi Username</dt>
              <dd>ctpaquette</dd>
              <dt>E-mail Address</dt>
              <dd>ctpaquette@gmail.com</dt>
              <dt>Password</dt>
              <dd>******** <a href="#"><small>change password</small></a></dd>
              <dt></dt>
            
              </dl>

                <div align="center">
                <p>
                <button class="btn btn-info" type="button" ><i class="icon-edit"></i> Update Information</button></p>
              </div>
          </div>

       
                <div align="right">
                <p>
                  <button class="btn btn-warning" type="button"><i class="icon-warning-sign"></i> Freeze Account</button>
                   </p>
                   <p>
                   <button class="btn btn-danger" type="button"><i class="icon-off"></i> Delete Account</button></p>

                 </div>

               </div> 
      

      </div>
            </div>

              </div>