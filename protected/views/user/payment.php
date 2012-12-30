<div class="container-fluid">
        <div class="row-fluid">
          <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
              <li class="nav-header">myMozi Interface</li>
              <li><a href="<?php echo Yii::app()->createUrl('user/home');?>"><i class="icon-chevron-right"></i> Dashboard</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('transaction/index');?>"><i class="icon-chevron-right"></i> View All Transactions</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/friends');?>"><i class="icon-chevron-right"></i> View All Friends</a></li>
              <li class="active"><a href="<?php echo Yii::app()->createUrl('user/payment');?>"><i class="icon-chevron-right"></i> Add/Delete Credit Card</a></li>
               <li><a href="<?php echo Yii::app()->createUrl('user/bank');?>"><i class="icon-chevron-right"></i> Add/Delete Bank Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/account');?>"><i class="icon-chevron-right"></i> Manage Mozi Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('account/help');?>"><i class="icon-chevron-right"></i> Help</a></li>
            </ul>
          </div>
          
            
         <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>

            <!--COLUMN-->
          <div class="span8">
            <h2><i class="icon-pencil" style="position:relative; top: 7px; right: 0px"></i> Add/Delete Credit Cards</h2> 
              <hr style="position:relative; top: -20px; right: 0px">
              
              <div class="span6">
                  <div class="navbar" style="margin-top:10px">
                  <div class="navbar-inner">
                      <h4>Primary Card</h4>
                  </div>
              </div>
              
              <dl class="dl-horizontal">
              <dt>Cardholder Name</dt>
              <dd>Christopher T Paquette</dd>
              <dt>Card Type</dt>
              <dd>American Express</dt>
              <dt>Card Number</dt>
              <dd>************8881</dt>
             <dt>Billing Address</dt>
             <dd>142 Front Street</dd>
             <dd>Apt. 2B</dd>
             <dd>Binghamton</dd>
             <dd>NY</dd>
             <dd>13905-3851</dt>
              </dl>


              <div align="center">
              <p>
              <button class="btn btn-info" type="button" ><i class="icon-edit"></i> Edit Card</button>
              <button class="btn btn-danger" type="button"><i class="icon-trash"></i> Delete Card</button></p>  
            </div>


            </div>

             <div class="span5">
                 <div class="navbar" style="margin-top:10px">
                  <div class="navbar-inner">
                      <h4>Secondary Card</h4>
                  </div>
              </div>
              <dl class="dl-horizontal">
              <dt>Cardholder Name</dt>
              <dd>Christopher T Paquette</dd>
              <dt>Card Type</dt>
              <dd>Visa</dt>
              <dt>Card Number</dt>
              <dd>************3661</dt>
             <dt>Billing Address</dt>
             <dd>142 Front Street</dd>
             <dd>Apt. 2B</dd>
             <dd>Binghamton</dd>
             <dd>NY</dd>
             <dd>13905-3851</dt>
              </dl>

              <div align="center">
              <p>
              <button class="btn btn-info" type="button" ><i class="icon-edit"></i> Edit Card</button>
              <button class="btn btn-danger" type="button" ><i class="icon-trash"></i> Delete Card</button>
             </p>  
             <button class="btn btn-success" type="button"> <i class="icon-star"></i> Make Primary Card</button>
            </div>


            </div>
            

          </div>

       </div>