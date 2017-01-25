<?php
namespace tunect\Yii2JsErrorHandler\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    }

	public function actionAdd()
	{
	}
}
