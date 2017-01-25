<?php
namespace tunect\Yii2JsErrorHandler\migrations;

use yii\db\Migration;
use tunect\Yii2JsErrorHandler\Module;

class m170125_185923_init extends Migration
{
	private $table_name;

	public function init()
	{
		parent::init();
		$this->table_name = \Yii::$app->getModule(Module::$moduleName)->table_name;
	}
    public function safeUp()
    {
		$this->createTable($this->table_name, [
			'id' => $this->primaryKey(),
			'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
			'page' => $this->string(),
			'user_id' => $this->integer()->notNull(),
			'error' => $this->string()->notNull(),
			'details' => $this->text(),
		]);

		$this->createIndex('idx-js_error-error', $this->table_name, ['error']);
		$this->createIndex('idx-js_error-page', $this->table_name, ['page']);
    }

    public function safeDown()
    {
		$this->dropIndex('idx-js_error-page', $this->table_name);
		$this->dropIndex('idx-js_error-error', $this->table_name);
		$this->dropTable($this->table_name);
    }
}
