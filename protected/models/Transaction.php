<?php

/**
 * This is the model class for table "{{transaction}}".
 *
 * The followings are the available columns in table '{{transaction}}':
 * @property integer $id
 * @property integer $recieverId
 * @property integer $senderId
 * @property string $description
 * @property double $amount
 * @property integer $status
 * @property integer $paymentType
 * @property integer $paymentTypeId
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{transaction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recieverId, senderId, amount, paymentType, paymentTypeId', 'required'),
			array('recieverId, senderId, status, paymentType, paymentTypeId', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, recieverId, senderId, description, amount, status, paymentType, paymentTypeId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'recieverId' => 'Reciever',
			'senderId' => 'Sender',
			'description' => 'Description',
			'amount' => 'Amount',
			'status' => 'Status',
			'paymentType' => 'Payment Type',
			'paymentTypeId' => 'Payment Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('recieverId',$this->recieverId);
		$criteria->compare('senderId',$this->senderId);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('status',$this->status);
		$criteria->compare('paymentType',$this->paymentType);
		$criteria->compare('paymentTypeId',$this->paymentTypeId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}