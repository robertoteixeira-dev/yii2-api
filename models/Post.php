<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['title', 'body'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}
