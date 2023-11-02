<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'app\models\Post';

    public function actionIndex()
    {
        $posts = Post::find()->all();
        return $posts;
    }

    public function actionView(Post $post)
    {
        return $post;
    }

    public function actionCreate()
    {
        $post = new Post();

        if ($post->load(Yii::$app->request->bodyParams, '') && $post->save()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'Post created successfully.',
                'post' => $post,
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to save the post.',
                'errors' => $post->getErrors(),
            ];
        }
    }

    public function actionUpdate(Post $post)
    {
        if ($post->load(Yii::$app->request->bodyParams, '') && $post->save()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'Post updated successfully.',
                'post' => $post,
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to update the post.',
                'errors' => $post->getErrors(),
            ];
        }
    }

    public function actionDelete(Post $post)
    {
        if ($post->delete()) {
            Yii::$app->response->setStatusCode(201);
            return [
                'status' => 'success',
                'message' => 'Post deleted successfully.',
            ];
        } else {
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Failed to delete the post.',
            ];
        }
    }
}
