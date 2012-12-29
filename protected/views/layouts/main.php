<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <style type="text/css">
            body 
            {
                padding-top: 45px;
                
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" /> 
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/form.css" /> -->
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        
        <?php
        
         $baseUrl = Yii::app()->baseUrl; 
 $cs = Yii::app()->getClientScript();
 $cs->registerScriptFile($baseUrl.'/js/bootstrap.js');

        
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
          <a class="brand" href="#"><img src="images/favicon.png" alt="mozi" width="23" height="23" ALIGN="MIDDLE"/></a>
          <div class="nav-collapse collapse">
               <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/account/index')),
				array('label'=>'About', 'url'=>array('/account/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/account/contact')),
				array('label'=>'Login', 'url'=>array('/account/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/account/logout'), 'visible'=>!Yii::app()->user->isGuest)
			), 'htmlOptions' => array('class' => 'nav')
		)); ?>
                
                
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
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
