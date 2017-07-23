<?php
namespace tunect\Yii2JsErrorHandler\models;

use tunect\Yii2JsErrorHandler\Module;

/**
 * This is the model class for table "{{%js_error}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $page
 * @property integer $user_id
 * @property string $error
 * @property string $details
 */
class Error extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return \Yii::$app->getModule(Module::$moduleName)->tableName;
    }

    public function rules()
    {
        return [
            ['user_id', 'integer'],
			['user_id', 'filter', 'filter' => 'intval'],
            ['details', 'safe'],
			[['user_id', 'error'], 'required'],
            [['page', 'error'], 'string', 'max' => 255],
        ];
    }

	public function beforeValidate()
	{
		if (strlen($this->page) > 255) {
			$this->page = substr($this->page, 0, 255);
		}
		return parent::beforeValidate();
	}
}
