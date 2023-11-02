<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionIndex()
    {
        $users = User::find()->all();
        return $users;
    }

    public function actionView(User $user)
    {
        return $user;
    }

    public function actionCreate()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->bodyParams, '') && $user->save()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'User created successfully.',
                'user' => $user,
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to save the user.',
                'errors' => $user->getErrors(),
            ];
        }
    }

    public function actionUpdate(User $user)
    {
        if ($user->load(Yii::$app->request->bodyParams, '') && $user->save()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'User updated successfully.',
                'user' => $user,
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to update the user.',
                'errors' => $user->getErrors(),
            ];
        }
    }

    public function actionDelete(User $user)
    {
        if ($user->delete()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'User deleted successfully.',
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to delete the user.',
            ];
        }
    }

}
