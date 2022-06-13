<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wishes".
 *
 * @property int $id
 * @property string $content
 */
class Wishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required', 'message' => 'Заполните поле'],
            [['content'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }

    public function saveWishes() {
        $model = new Wishes();
        $model->content = $this->content;
        $model->save();
    }
}
