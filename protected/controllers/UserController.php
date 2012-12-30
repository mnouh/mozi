<?php

class UserController extends Controller
{
    
    private $layout = 'privateHome';
    
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionHome()
        {
            
            $this->layout = 'privateHome';
            $model = User::model()->findByPk(Yii::app()->user->id);
            
            
            
            $this->render('home', array('model' => $model));
            
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