<?php

$currentUser = Yii::app()->user->id;

$sender = true;
if($model->recieverId == $currentUser) {
    $sender = false;
}

$friend;
if($sender) {
    
    $friend = User::model()->findByPk($model->recieverId);
    
}
else {
    $friend = User::model()->findByPk($model->senderId);
    
}
$status;
if($model->status == 0)
    $status = 'Pending';
elseif($model->status == 1)
    $status = 'Paid';
elseif($model->status == 2)
    $status = 'Recieved';
else
    $status = 'In Progress';
    




?>
<div class="entry warning row" style="padding-top:8px; border-top: 1px solid #dddddd;">
                      
                      <div class="span1"><?php echo $model->id;?></div>
                      <div class="span2">12/29/2012</div>
                      <div class="span5"><?php echo $friend->firstName.' '.$friend->lastName;?>&nbsp;<small><b>@<?php echo $friend->username;?></b></small></div>
                      <div class="span2"><?php echo $model->amount;?></div>
                      <div class="span1"><?php echo $status;?></div>
                      
                  </div>