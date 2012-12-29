<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="form" style="text-align:center; width:700px; margin-left:auto; margin-right:auto;">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <?php
    
    if($model->hasErrors()) {
    ?>
      
      <div class="alert" style="text-align: left;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Wrong Username/Email and password combination.
</div>  
    <?php    
    
    }
    ?>
    
    
    
            <div class="row"><?php echo $form->textField($model,'email', array('placeholder' => 'E-mail or User Name')); ?>
            
            </div>
    
            <div class="row"><?php echo $form->passwordField($model,'password', array('placeholder' => 'Password', 'autocomplete' => 'off')); ?>
            </div>
            <div class="row">
                
            <?php echo CHtml::submitButton('Log in', array('class' => 'btn btn-primary', 'style' => 'margin-top:10px; margin-right:10px;')); ?>
                <br>
             <a href="signup.html"><small>Forgot Your Password?</small></a></div>
     
<?php $this->endWidget(); ?>
</div>

