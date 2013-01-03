<div class="container">
        <div style="width:700px; margin-left:auto; margin-left: 25%;">
        <div class="row" style="margin-left: 3px; margin-top:70px;">
            
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-recovery-form',
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
          
  <div class="colspan8 coloffset2" style="padding-left: 0px">
    <div class="page-header" >
      <h1>Account Recovery</h1>
    </div>
  </div>
            </div>
  <div class="colspan8 coloffset2">
    <div style="margin:0;padding:0;display:inline"></div>
    

      

      <p class="input">
        <label for="user_email" style="font-weight:bold;">Email</label>
        <?php echo $form->textField($model,'email');?>
      </p>


      <p id="login-button"><?php echo CHtml::submitButton('Retrieve', array('class' => 'btn btn-primary')); ?></p>
      <p id="reset-pw"><a href="/account/recoveremail">Forgot your email/username?</a></p>
  </div><!-- /colspan -->
  
  
  <div class="colspan8 coloffset2">
    <hr>
    <h3>Dont have an account?</h3>
    <p>Mozi is quick and easy to use, if you need an account please sign up here.</p>
    <p>
                <?php 
                
                echo CHtml::submitButton('Signup', array('class' => 'btn'));
              /*
                echo CHtml::ajaxSubmitButton(
                                        'Retrieve',
                                        array('account/recovery'),
                                        array(
                                                //'success'=>'js:function(data) {
                                                 // jQuery("div#status").html(data);}',
                                                //'update'=>'#successMessage',
                                                //'beforeSend' => 'function() {alert("testing");}',
                                                //'validated' => 'function() {$("div#load").removeClass("loading");}',
                                                //'complete' => 'function() {$("div.login").slideUp();}',
                                                'type' => 'POST'
                                        ),
                                        array('class' => 'btn')
                                        
                                        
                                );
               * 
               */
      
      ?>
            </p>
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

      














