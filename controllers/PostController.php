<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'view' => ['GET'],
                    'create' => ['POST'],
                    'update' => ['PUT', 'PATCH'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $posts = Post::find()->all();
        return $posts;
    }

    public function actionView(Post $post)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
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
                'data' => $post,
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
                'data' => $post,
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
