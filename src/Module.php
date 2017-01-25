<?php
namespace tunect\Yii2JsErrorHandler;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module
{
    public static $moduleName = 'js-error-handler';
	public $table_name = '{{%js_error}}';
	
    public function init()
    {
        parent::init();
    }
}