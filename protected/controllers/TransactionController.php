<?php

class TransactionController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionView($id)
        {
            
            
        }
        /**
         * if Type = 1 Current User is Making a Payment
         * If Type = 2 Current User wants to Recieve a Payement
         * 
         * @throws CHttpException 
         */
        public function actionCreate()
        {
            
            $model = new Transaction;
           
           
           if(isset($_POST['Transaction']['recieverId']) && isset($_POST['description']) && isset($_POST['transType'])) {
               
            if(!empty($_POST['Transaction']['recieverId']) && !empty($_POST['description']) && !empty($_POST['transType'])) {
               $id = $_POST['Transaction']['recieverId'];
               $rawDescription = $_POST['description'];
               $type = $_POST['transType'];
               
               
               
               if(Yii::app()->user->isGuest)
                   throw new CHttpException(404, 'The requested page does not exist.');
               
               
               
               //initiates the transaction
               $user_id = Yii::app()->user->id;
               $user = User::model()->findbyPk($user_id);
               
               
               //Making a Payment
               if($type == 1) {
                
                   $model->senderId = $user_id;
                   $model->recieverId = $id;
                   
               }
               
               else {
                   
                   $model->recieverId = $user_id;
                   $model->senderId = $id;
                   
                   
               }

               $model->amount = $rawDescription;
               $model->status = 0;
               $model->paymentType = 1;
               $model->paymentTypeId = 4123012398;
               $model->date = new CDbExpression('NOW()');
               
               if($model->validate()) {
                
                if($model->save()) {
             
                    
                    $this->renderPartial('entry', array('model' => $model, 'user' => $user));
                    
                }
                
            }
               
           }
           }
         
        }
        
        public function actionTest()
        {
            
        $app_id	= '34552';
	$secret	= '57d22d37931060f92e98';
	$api_key = '721c7d62cacee28479b2';
            
        $pusher = new Pusher($api_key, $secret, $app_id);
        
        
        $message = array('message' => 'new transaction pending', 'transactionId' => 36, 'type' => '2');
        $message = json_encode($message);
            
            $pusher->trigger('private_7', 
                 'my_event', 
                 $message);
            
        }
        
        public function actionShowEntry()
        {
            
            if(isset($_POST['transId']) && !empty($_POST['transId'])) {
                
                $id = $_POST['transId'];
                
                $model = Transaction::model()->findByPk($id);
                
                
                $this->renderPartial('entry', array('model' => $model));
                
            }
            
        }
        
        public function actionNotification()
        {
            
            
            $this->renderPartial('notify');
            
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}