<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issued_service".
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property string $full_name
 * @property string $telephone_number
 * @property string $date_time
 * @property string $status
 *
 * @property PurchasedService[] $purchasedServices
 * @property PurchasedService[] $purchasedServices0
 * @property Services $service
 * @property User $user
 */
class IssuedService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'issued_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'full_name', 'telephone_number', 'date_time', 'status'], 'required'],
            [['user_id', 'service_id'], 'integer'],
            [['date_time'], 'safe'],
            [['full_name'], 'string', 'max' => 100],
            [['telephone_number'], 'string', 'max' => 11],
            [['status'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
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
            'full_name' => 'Full Name',
            'telephone_number' => 'Telephone Number',
            'date_time' => 'Date Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[PurchasedServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasedServices()
    {
        return $this->hasMany(PurchasedService::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[PurchasedServices0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasedServices0()
    {
        return $this->hasMany(PurchasedService::className(), ['service_id' => 'service_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function saveIssuedService() {
        $session = Yii::$app->session;
        $model = new IssuedService();
        $model->full_name = $this->full_name;
        $model->telephone_number = $this->telephone_number;
        $model->user_id = $session['__id'];
        $model->service_id = (int)$_GET['service'];
        $model->date_time = date('Y-m-d H:i');
        $model->status = 'Новый';
        $model->save();
    }
}
