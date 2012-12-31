<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'events-form',
	'enableAjaxValidation'=>false,
)); ?>
                    <h3>Payment Hub</h3>
                 
                        <div class="input-append">
                     <?php
                        echo CHtml::ajaxLink(
                                'Send', array('user/pay'), array('success' => 'js:function(data) {
                                                    jQuery("div#status").html(data);}',
                            //'update'=>'#successMessage',
                            //'beforeSend' => 'function() {alert("testing");}',
                            //'validated' => 'function() {$("div#load").removeClass("loading");}',
                            //'complete' => 'function() {$("div#load").removeClass("loading");}',
                            'type' => 'POST'
                                ),
                                array('class' => 'btn')
                        );
                        ?>
                     
                     
                     <?php
                        echo CHtml::ajaxLink(
                                'Request', array('user/request'), array('success' => 'js:function(data) {
                                                    jQuery("div#status").html(data);}',
                            //'update'=>'#successMessage',
                            //'beforeSend' => 'function() {alert("testing");}',
                            //'validated' => 'function() {$("div#load").removeClass("loading");}',
                            //'complete' => 'function() {$("div#load").removeClass("loading");}',
                            'type' => 'POST'
                                ),
                                array('class' => 'btn btn-primary')
                        );
                        ?>
                     
                     

                     
      <?php echo $form->error($model,'recieverId'); ?>
        <?php //$result[] = array('id' => $business->id, 'name' => $business->name); ?>
        
    <?php $this->widget('ext.tokeninput.TokenInput', array(
        'model' => $model,
        'attribute' => 'recieverId',
        'url' => array('user/contacts'),
        //'value' => 'Terminal 5',
        'options' => array(
            'allowCreation' => false,
            'preventDuplicates' => true,
            'tokenLimit' => 1,
            'createTokenText'  => "(Create a new contact)",
            'resultsFormatter' => 'js:function(item){ return "<li><div class=row><div class=span1> " + "<img src="+ item.user_url + " width=50px/></div> <div class=span2 style=font-family: Verdana; margin-left:0px><b> " + item.firstName + " " + item.lastName + "<b><br><small style=color: #0099CC>" + "<img src="+ item.url + " width=20 />" + item.name + " </small></div></div></li>"}',
            'theme' => 'facebook',
            
            
            
            
        )
    )); ?>
                     
        <input name="transType" type="hidden" value="2"/>
                     
                 
                    </div>
                    
                    <div class="med_gray_box mainTextBox" style="position:relative; width:545px; border-radius:3px;">
                <span class="paddingDollar" style="float:left;">$</span>
                <div class="absolute" style="position:absolute; padding-top:5px; top: 0px; right: 0px;">
                </div>
                <textarea tabindex="2" name="description" style="width:440px;" id="onebox_details" class="medium light_gray" placeholder="5.75 for ice cream!" ></textarea>
                </div>
                
                    
                <!--
                    <div>
                        <span style="position:relative; top:-15px;">$</span><textarea style="outline:none;" id="onebox_details" name="description" cols="86" rows="2" placeholder="10.50 for ..."></textarea>
                    </div>
                -->
                    
                        <div style="margin-top:10px;">
                        <button id="createTransaction" class="btn btn-info" type="button">Charge</button>
                        </div>
                  
              </div>
                    <?php $this->endWidget(); ?>