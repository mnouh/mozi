<?php

$currentUser = Yii::app()->user->id;

$sender = true;
if($data->recieverId == $currentUser) {
    $sender = false;
}

$user;
if($sender) {
    
    $user = User::model()->findByPk($data->recieverId);
    
}
else {
    $user = User::model()->findByPk($data->senderId);
    
}
$status;
if($data->status == 0)
    $status = 'Pending';
elseif($data->status == 1)
    $status = 'Paid';
elseif($data->status == 2)
    $status = 'Recieved';
else
    $status = 'In Progress';
    




?>
<div class="entry row" style="padding-top:8px; border-top: 1px solid #dddddd;">
                      
                      <div class="span1"><?php echo $data->id;?></div>
                      <div class="span2"><?php echo $data->date;?></div>
                      <div class="span5"><?php echo $user->firstName.' '.$user->lastName;?>&nbsp;<small><b>@<?php echo $user->username;?></b></small></div>
                      <div class="span2"><?php echo $data->amount;?></div>
                      <div class="span1"><?php echo $status;?></div>
                      
                  </div>