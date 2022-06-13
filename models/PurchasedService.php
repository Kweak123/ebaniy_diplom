<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "purchased_service".
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property string $login
 * @property string $full_name
 * @property int $price
 * @property string $date_time
 *
 * @property IssuedService $service
 * @property IssuedService $user
 */
class PurchasedService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchased_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'login', 'full_name', 'price', 'date_time'], 'required'],
            [['user_id', 'service_id', 'price'], 'integer'],
            [['date_time'], 'safe'],
            [['login', 'full_name'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => IssuedService::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => IssuedService::className(), 'targetAttribute' => ['service_id' => 'service_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_id' => 'Service ID',
            'login' => 'Login',
            'full_name' => 'Full Name',
            'price' => 'Price',
            'date_time' => 'Date Time',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(IssuedService::className(), ['service_id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(IssuedService::className(), ['user_id' => 'user_id']);
    }

    public function saveFinalOrder() {
        $clientServiceInfo = IssuedService::findOne($_POST['buy-service-button']);
        $userInfo = User::findOne($clientServiceInfo->user_id);
        $serviceInfo = Services::findOne($clientServiceInfo->service_id);
        $model= new PurchasedService();
        $model->user_id = $clientServiceInfo->user_id;
        $model->service_id = $clientServiceInfo->service_id;
        $model->login = $userInfo->login;
        $model->full_name = $clientServiceInfo->full_name;
        $model->price = $serviceInfo->price;
        $model->date_time = date('Y-m-d H:i');
        $model->save();

        $clientServiceInfo->status = 'Оплаченный';
        $clientServiceInfo->save();
    }
}
