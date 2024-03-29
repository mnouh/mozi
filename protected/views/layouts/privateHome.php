<?php
$currentUserId = Yii::app()->user->id;
$notificationUrl = Yii::app()->createUrl('user/notification');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/main.css" /> -->
        
        <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;
    var currentUser = '<?php echo $currentUserId; ?>';
    var notificationUrl = '<?php echo $notificationUrl; ?>';
    var pusher = new Pusher('721c7d62cacee28479b2');
    var channel = pusher.subscribe('private_'+currentUser);
    channel.bind('my_event', function(data) {
        
        //alert(data);
        var decodedData = jQuery.parseJSON(data);
        //decodedData = String(decodedData);
        
        jQuery.ajax({
                    'type':'POST',
                    'url':notificationUrl,
                    'cache':false,
                    'data': decodedData,
                    'success':
                        function(html){
                        $('div#statusUpdate').prepend(html);
                        //$("textarea#description").val('');
                        //$("input").val('');
                        
                    }});
    });
  </script>
        
        
        
        
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" />
        <style type="text/css">
            body 
            {
                padding-top: 45px;
                
                
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/docs.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dropdown.css" />
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/form.css" /> -->
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        
        <?php
        
         $baseUrl = Yii::app()->baseUrl; 
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/bootstrap.js');
 $cs->registerScriptFile($baseUrl.'/js/inner.js');
 $cs->registerScriptFile($baseUrl.'/js/key.js');

        
        ?>
        

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    
    
    
    <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li> <a href="<?php echo Yii::app()->createUrl('account/index');?>"><img src="images/favicon_logo.png" alt="mozi" width="60" height=
            "30" ALIGN="MIDDLE"></a></li>
            <li>
                 <input style="position: absolute; top: 10px" type="text" class="input-xlarge search-query" placeholder="Search friends or payments...">
               </li>
            </ul>
             
            
                  
                 <div style="float:right; padding-top: 3px" class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="<?php echo Yii::app()->createUrl('user/home');?>">
    <i class="icon-user"></i> Account
    <span class="caret"></span>
  </a>
     <ul class="dropdown-menu">
<li><a href="howitworks.html">How It Works</a></li>
<li><a href="howitworks.html">How It Works</a></li>
<li> <a href="howitworks.html"><i class="icon-cog"></i>&nbsp;Settings</a></li>
<li class="divider"></li>
<li><a href="<?php echo Yii::app()->createUrl('account/logout');?>">Logout</a></li>

    </ul>
                     
              </div>
              <?php
              $model = User::model()->findByPk(Yii::app()->user->id);
                  ?>
              <div class="nav-collapse collapse" style="float:right;">
                  <ul class="nav">
                      <li><a style="padding-top: 15px" href="<?php echo Yii::app()->createUrl('user/home');?>"><?php echo $model->firstName .' '.$model->lastName;?></a></li>
                      <li><a style="padding-top: 15px" href="<?php echo Yii::app()->createUrl('user/home');?>">Dash Board</a></li>
                      <li><a style="padding-top: 15px" href="<?php echo Yii::app()->createUrl('account/about');?>">Marketplace</li>
                  </ul>
              </div>
              
              <div style="float:right; padding-top: 8px; padding-right: 10px;"><img src="images/userprofileimg.jpg" alt="mozi" width="30" height=
            "30"></div>
                  
            
            
           </div>
           
          </div><!--/.nav-collapse -->
        </div>
      </div>
    
    

	<?php echo $content; ?>


    
    <div class="footer">
  <div class="container">
    <img src="images/favicon.png" alt="mozi" width="23" height="23" ALIGN="MIDDLE"/>
    <p>
      <a href="https://github.com/about">About us</a>
      &middot;
      <a href="/privacy">Privacy</a>
      &middot;
      <a href="/contact">Contact</a>
    </p>
    <p>&copy; 2012 MoziMe, Inc. All rights reserved.</p>
  </div>
</div>
</body>
</html>
