<?php

class UserController extends Controller
{
    
    public $layout = 'privateHome';
    
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionHome()
        {
            
            $this->layout = 'privateHome';
            $user = User::model()->findByPk(Yii::app()->user->id);
            $model = new Transaction;
            
             $sort = new CSort();
  $sort->attributes = array(
    '*', // add all of the other columns as sortable
  );
            
            $dataTransactionProvider=new CActiveDataProvider('Transaction', array(
        'criteria'=>array(
        'alias' => 'Transaction',
        'condition' => "recieverId = $user->id OR senderId = $user->id",
            
            
            //'join' => "LEFT JOIN tbl_user m ON (Transaction.recieverId = $user->id), Transaction.senderId = $user->",
        
            //'condition'=>"m.id <> $model->id AND (m.categories LIKE '%$topCat%') AND ((3959*acos(cos(radians($lat))*cos(radians(m.lat))*cos(radians(m.lng)-radians($lng))+sin(radians($lat))*sin(radians(m.lat)))) <= $radius)",
        
        'order' => "id DESC",
        
    ),
        'sort'=>$sort,
    'pagination'=>array(
        'pageSize'=>10,
        
    ),
    ));
            
            
            
    
            
            $this->render('home', array('model' => $model, 'user' => $user, 'dataProvider' => $dataTransactionProvider));
            
        }
        
        public function actionPay()
        {
            $model = new Transaction;
            
            $this->renderPartial('_pay', array('model' => $model), false, true);
        }
        
        public function actionRequest()
        {
            $model = new Transaction;
            
            $this->renderPartial('_request', array('model' => $model), false, true);
        }
        
        public function actionFriends()
        {
            
            $this->render('friends');
        }
        
        public function actionPayment()
        {
            
            $this->render('payment');
        }
        
        public function actionBank()
        {
            
            $this->render('bank');
        }
        
        public function actionAccount()
        {
            
            $this->render('account');
        }
        
        /**
         *Type # 1 -> New Transaction Message
         * Type # 2 -> Reciever Accepted Transaction. 
         */
        public function actionNotification()
        {
            /**
             * Correct Format:
             * {"message":"new transaction pending","transactionId":36,"type":"1"}
             * [["message", "new transaction pending"], ["transactionId", 42], ["type", 1]]
             */
            
            if(isset($_POST['type']) && isset($_POST['message'])) {
            
                if(!empty($_POST['type'])) {
            
                    $notificationType = $_POST['type'];
                    //Transaction Message
                    if($notificationType == 1) {
            
                        if(isset($_POST['transactionId']) && !empty($_POST['transactionId'])) {
                            
                            $transactionId = $_POST['transactionId'];
            
                        
                        $model = Transaction::model()->findBypk($transactionId);
                        
                        $sender = User::model()->findbyPk($model->senderId);
                        
                        
                        $this->renderPartial('notificationTransaction', array('model' => $model, 'sender' => $sender));
                        
                        
                        }
                        
                    }
                    
                    elseif($notificationType == 2) {
                        
                        
                        if(isset($_POST['transactionId']) && !empty($_POST['transactionId'])) {
                            
                            $transactionId = $_POST['transactionId'];
            
                        
                        $model = Transaction::model()->findBypk($transactionId);
                        
                        $reciever = User::model()->findbyPk($model->recieverId);
                        
                        
                        $this->renderPartial('acceptTransaction', array('model' => $model, 'reciever' => $reciever));
                        
                        
                        }
                        
                        
                        
                    }
                    else {
                        
                        
                    }
                    
                    
                    
                }
            }
            
        }
        
        
        
        public function actionContacts($q) {

        //$this->render('find');



        $term = trim($q);
        $result = array();

        if (!empty($term)) {
            $criteria = new CDbCriteria;
            $criteria->select = "id, username, firstName, lastName, email, twitterId, facebookId";


            $criteria->condition = "(username LIKE :venue OR twitterId LIKE :venue OR facebookId LIKE :venue) AND id <> :owner";

            //echo $criteria->condition;

            $user_id = NULL;
            if (!Yii::app()->user->isGuest) {

                $user_id = Yii::app()->user->id;
            }

            $term = '%' . $term . '%';

            $criteria->params = array(
                ':venue' => $term,
                ':owner' => $user_id,
            );
            $criteria->limit = 5;
            $cursor = User::model()->findAll($criteria);


            //$cursor = Marker::model()->query()->findCursor(array('name' => new MongoRegex('/' . $term . '/i')), array('name'), array('name' => 1), 10);

            if ($cursor != NULL) {
                // echo "Test";
                foreach ($cursor as $id => $value) {
                    
                    $result[] = array('id' => $value['id'], 'firstName' => $value['firstName'], 'lastName' => $value['lastName'], 'name' => $value['username'], 'twitterId' => $value['twitterId'], 'facebookId' => $value['facebookId'], 'url' => 'http://www.mozime.com/images/favicon.png', 'user_url' => 'images/blankuser.gif');
                }
            }
            
        }

        header('Content-type: application/json');
        echo CJSON::encode($result);
        Yii::app()->end();
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