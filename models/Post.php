<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public $id;
    public $title;
    public $body;
    public $created_by;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            ['title', 'string', 'max' => 255],
            ['body', 'string'],
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

    public static function tableName()
    {
        return '{{%post}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}
