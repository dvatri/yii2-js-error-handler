<?php
namespace tunect\Yii2JsErrorHandler;

use Yii;

class Module extends \yii\base\Module
{
    public static $moduleName = 'js-error-handler';
	public $tableName = '{{%js_error}}';
	public $roles = ['@'];

	private $js = <<<'JS'
	window.onerror = function(msg, url, line, column, error){
		$.ajax({
			url: "/%path%/add",
			method: "POST",
			data: {
				user_id : %user_id%,
				page : "%page%",
				details : error.stack,
				error : msg
			}
		});
	};
JS;
	
    public function init()
    {
        parent::init();
		$this->layout = Yii::$app->layout;
		$this->layoutPath = Yii::$app->layoutPath;
    }

	public function registerErrorHandler()
	{
		$js = strtr($this->js, [
			'%path%' => $this::$moduleName,
			'%user_id%' => (Yii::$app->user->id ? Yii::$app->user->id : 0),
			'%page%' => Yii::$app->getRequest()->getUrl(),
		]);

		\Yii::$app->getView()->registerJs($js, \yii\web\View::POS_READY);
	}

	public function getRoles()
	{
		if (is_callable($this->roles)) {
			return $this->roles();
		}
		if (is_array($this->roles)) {
			return $this->roles;
		}
		return [$this->roles];
	}
}