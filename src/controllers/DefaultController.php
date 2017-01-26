<?php
namespace tunect\Yii2JsErrorHandler\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use tunect\Yii2JsErrorHandler\models\Error;

class DefaultController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
			'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
		$dataProvider = new ActiveDataProvider([
            'query' => Error::find(),
			'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionAdd()
	{
		if (!Yii::$app->request->isAjax) {
			throw new \yii\base\InvalidCallException('Ajax requests only');
		}
		$model = new Error();
		if (!$model->load(Yii::$app->request->post(), '') || !$model->save()) {
			throw new \yii\base\InvalidParamException('Data validation error');
		}
	}
}
