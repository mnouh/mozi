<div class="container-fluid">
        <div class="row-fluid">
          <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
              <li class="nav-header">myMozi Interface</li>
              <li><a href="<?php echo Yii::app()->createUrl('user/home');?>"><i class="icon-chevron-right"></i> Dashboard</a></li>
              <li class="active"><a href="<?php echo Yii::app()->createUrl('transaction/index');?>"><i class="icon-chevron-right"></i> View All Transactions</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/friends');?>"><i class="icon-chevron-right"></i> View All Friends</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/payment');?>"><i class="icon-chevron-right"></i> Add/Delete Credit Card</a></li>
               <li><a href="<?php echo Yii::app()->createUrl('user/bank');?>"><i class="icon-chevron-right"></i> Add/Delete Bank Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/account');?>"><i class="icon-chevron-right"></i> Manage Mozi Account</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('account/help');?>"><i class="icon-chevron-right"></i> Help</a></li>
            </ul>
          </div>
          
            
         <div id="space" style="padding-bottom:15px;">
           &nbsp;  </div>

            <!--TRANSACTION COLUMN-->
            
          <div class="span8">
              <h3>Transaction History</h3>

            <form class="form-search">
           <input type="text" class="input-xlarge search-query">
             <button type="submit" class="btn">Search All Transactions</button>
              </form>

          <table class="table table-hover">
                  <td><strong>#</strong></td>
                  <td><strong>Time</strong></td>
                  <td><strong>Customer</strong></td>
                  <td><strong>Notes</strong></td>
                  <td><strong>Amount</strong></td>
                  <td><strong>Status</strong></td>
                  
                  <tr>
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
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5813</td>
                    <td>Jan 1, 2013</td>
                    <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5812</td>
                    <td>Jan 1, 2013</td>
                    <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5811</td>
                    <td>Jan 1, 2013</td>
                    <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5810</td>
                    <td>Jan 1, 2013</td>
                    <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5809</td>
                    <td>Jan 1, 2013</td>
                   <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5808</td>
                    <td>Jan 1, 2013</td>
                   <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5807</td>
                    <td>Jan 1, 2013</td>
                  <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
                  <tr>
                    <td>5806</td>
                    <td>Jan 1, 2013</td>
                  <td>George Murphy <small>@gmurphy19</small></td>
                    <td>#smallcombo</td>
                    <td>$7.72</td>
                    <td>Received</td>
                  </tr>
              </table>



          </div>

       </div>
</div>