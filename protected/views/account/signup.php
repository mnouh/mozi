<div class="container">
    <div class="row">
    <div class="page-header">
      <h3>Sign Up</h3>
      
    </div>
    </div>
    <div class="form" style="width:940px; margin-left: auto; margin-right:auto;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'signup-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    
<div class="row-fluid">
        <div class="span6">
          <form>
          <fieldset>
             <div><?php echo $form->label($model, 'firstName', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'firstName');?>
             <?php echo $form->error($model, 'firstName', array('style' => 'display:inline;'));?>    
             </div>
              <div>
             <?php echo $form->label($model, 'lastName', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'lastName');?>
              <?php echo $form->error($model, 'lastName', array('style' => 'display:inline;'));?> 
              </div>
              <div>
             <?php echo $form->label($model, 'email', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'email');?>
             <?php echo $form->error($model, 'email', array('style' => 'display:inline;'));?> 
              </div>
              <div>
             <label><b>Desired Mozi User Name</b></label>
             <?php echo $form->textField($model,'username');?>
             <?php echo $form->error($model, 'username', array('style' => 'display:inline;'));?> 
              </div>
              <div>
             <?php echo $form->label($model, 'password', array('style' => 'font-weight:bold'));?>
             <?php echo $form->passwordField($model,'password');?>
             <?php echo $form->error($model, 'password', array('style' => 'display:inline;'));?> 
              </div>
              <div>
             <?php echo $form->label($model, 'confirmPassword', array('style' => 'font-weight:bold'));?>
             <?php echo $form->passwordField($model,'confirmPassword');?>
             <?php echo $form->error($model, 'confirmPassword', array('style' => 'display:inline;'));?> 
              </div>
             <small>By clicking 'Sign Up' you agree to our <a href="#termsAgreement">Terms</a> and that you understand the Mozi <a href="#privacyPolicy">Privacy and Personal Information Use Policy</a>
            </small>
             <label></label>
             <p><?php echo CHtml::submitButton('Sign Up', array('class' => 'btn btn-large btn-primary')); ?></p>
           </fieldset>
          </form>
        </div>
      
   		<div class="span6">
   			<div class="row" style="position:relative; top: -10px; right: 0px">
        <h3 align="center">Send money to friends and family <u>instantly</u></h3></div>

          <div class="span9 offset1" style="padding-bottom:25px;">
            <img src="images/peoplephones2.jpg" alt="Pulpit rock"/>
            </div>
                    
                    <div class="row">
        <div class="span6" align="center">
        <h2 align="center">2.9% + $0.30</h2>
         <h4>per transaction in Mozi Beta</h4>
        </div>
   	<div class="span6"  align="center">
   			  <h5>No Monthly Fees</h5>
          <h5>No Setup Fees</h5>
          <h5>No Recurring Fees</h5>
   	</div>
    </div>

                </div>
      </div>
<?php $this->endWidget(); ?>
</div>
</div>