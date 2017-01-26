<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="js-error-default-index">

	<h2><?= Html::encode('Javascript errors')?></h2>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			'created_at:datetime',
			'page',
			'error',
			[
				'attribute' => 'user_id',
				'value' => function($data){
					return $data->user_id ? $data->user_id : 'guest';
				},
			],
			[
				'attribute' => 'details',
				'format' => 'ntext',
				'contentOptions' => ['class' => 'small'],
			],
        ],
    ]); ?>
</div>
