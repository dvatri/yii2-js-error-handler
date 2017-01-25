<?php
namespace tunect\Yii2JsErrorHandler;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $name = Module::$moduleName;

        if ($app instanceof \yii\web\Application) {
            if (!$app->hasModule($name)) {
                $app->setModule($name, new Module($name));
            }
            $rules[] = [
                'class' => 'yii\web\GroupUrlRule',
                'prefix' => $name,
                'rules' => [
                    '/' => 'default/index',
                    'add' => 'default/create',
                    '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                ],
            ];
            $app->getUrlManager()->addRules($rules, false);
        } elseif ($app instanceof \yii\console\Application) {
			
        }
    }
}