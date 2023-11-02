<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['full_name', 'email', 'password'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['email'], 'email'],
            ['email', 'unique', 'message' => 'This email is already being used.'],
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, ['user_id' => 'id']);
    }
}
