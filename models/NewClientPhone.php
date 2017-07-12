<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "client_phone".
 *
 * @property integer $id
 * @property integer $client_id
 * @property string $phone
 */
class NewClientPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['client_id'], 'integer'],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'phone' => 'Phone',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(NewClient::className(), ['id' => 'client_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
 
        $client = NewClient::findOne($this->client_id);
        $client->updated = new Expression('NOW()');
        $client->update();
    }
}
