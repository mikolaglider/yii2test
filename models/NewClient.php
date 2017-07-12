<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $lastname
 * @property string $name
 * @property string $middlename
 * @property string $birthday
 * @property string $sex
 * @property string $added
 * @property string $updated
 */
class NewClient extends \yii\db\ActiveRecord
{
    public $allSearch;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['lastname', 'name', 'middlename', 'birthday', 'sex'], 'required'],
            [['birthday'], 'date', 'format' =>'yyyy-MM-dd'],
            [['sex'], 'in', 'range' => ['male', 'female']],
            [['lastname', 'name', 'middlename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Lastname',
            'name' => 'Name',
            'middlename' => 'Middlename',
            'birthday' => 'Birthday',
            'sex' => 'Sex',
            'added' => 'Added',
            'updated' => 'Updated',
            'allSearch' => 'Lastname or Phone',
        ];
    }

    public function getPhones()
    {
        return $this->hasMany(NewClientPhone::className(), ['client_id' => 'id']);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        NewClientPhone::deleteAll(['client_id' => $this->id]);
    }

    public function behaviors()
    {
        return [
            // Other behaviors
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'added',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];   
    }
}
