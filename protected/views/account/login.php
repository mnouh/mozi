<div class="container">
        <div style="width:700px; margin-left:auto; margin-right:auto;">
        <div class="row">
            
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
  <div class="colspan8 coloffset2">
    <div class="page-header">
      <h1>Sign in</h1>
    </div>
  </div>
            </div>
  <div class="colspan4 coloffset2">
    <div style="margin:0;padding:0;display:inline"></div>
    

      

      <p class="input">
        <label for="user_email" style="font-weight:bold;">Email</label>
        <?php echo $form->textField($model,'email');?>
      </p>

      <p class="input">
        <label for="user_password" style="font-weight:bold;">Password</label>
        <?php echo $form->passwordField($model,'password');?>
      </p>

      <p id="login-button"><?php echo CHtml::submitButton('Log in', array('class' => 'btn btn-primary')); ?></p>
      <p id="reset-pw"><a href="Yii::app()->createUrl('account/recovery');">Forgot your password?</a></p>
  </div><!-- /colspan -->
  <div class="colspan1">
    <span class="form-signin-divider">or</span>
  </div>
  <div class="colspan2" style="margin-top:65px">
    <p id="login-button"><button type="submit" class="btn">via Facebook</button></p>
  </div><!-- /colspan -->

  <div class="colspan8 coloffset2">
    <hr>
    <h3>Dont have an account?</h3>
    <p>Mozi is quick and easy to use, if you need an account please sign up here.</p>
    <p><?php echo CHtml::link('Signup', array('/account/signup'));?></p>
  </div>

</div><!-- /row -->
<?php $this->endWidget(); ?>

    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        &nbsp;
    </div>
<div class="row">
        &nbsp;
    </div>
<div class="row">
        &nbsp;
    </div>
</div>

      