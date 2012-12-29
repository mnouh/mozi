<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<?php

echo CHtml::errorSummary($model);

?>
<div class="row-fluid">
        <div class="span5" style="padding-left:45px;">
          <form>
          <fieldset>
              <legend><h2>It's free to join!</h2></legend>
             <div><?php echo $form->label($model, 'firstName', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'firstName');?>
             <?php echo $form->error($model, 'firstName', array('style' => 'display:inline;'));?>    
             </div>
             <?php echo $form->label($model, 'lastName', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'lastName');?>
             <?php echo $form->label($model, 'email', array('style' => 'font-weight:bold'));?>
             <?php echo $form->textField($model,'email');?>
             <label><b>Desired Mozi User Name</b></label>
             <?php echo $form->textField($model,'username');?>
             <?php echo $form->label($model, 'password', array('style' => 'font-weight:bold'));?>
             <?php echo $form->passwordField($model,'password');?>
             <?php echo $form->label($model, 'confirmPassword', array('style' => 'font-weight:bold'));?>
             <?php echo $form->passwordField($model,'confirmPassword');?>
             <label></label>
             <small>By clicking 'Sign Up' you agree to our <a href="#termsAgreement">Terms</a> and that you understand the Mozi <a href="#privacyPolicy">Privacy and Personal Information Use Policy</a>
            </small>
             <label></label>
             <p><?php echo CHtml::submitButton('Sign Up', array('class' => 'btn btn-large btn-primary')); ?></p>
           </fieldset>
          </form>
        </div>
      
   		<div class="span6 offset1">
   			<div class="row" style="position:relative; top: -10px; right: 0px">
        <h3 align="center">Send money to friends and family <u>instantly</u></h3></div>

          <div class="span9 offset2" style="padding-bottom:25px;">
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