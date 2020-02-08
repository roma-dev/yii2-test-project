<?php

namespace app\commands;


use app\models\base\Users;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\Role;

class UserController extends Controller
{
    public function actionCreate($login, $email, $password, $status = 0)
    {
        $user = new Users([
            'login' => $login,
            'email' => $email,
            'password' => $password,
            'status' => $status,
        ]);

        if ($user->validate() && $user->save()) {
            return ExitCode::OK;
        }

        foreach ($user->errors as $error) {
            echo $error . PHP_EOL;
        }

        return ExitCode::DATAERR;
    }

    public function actionCreateRole($roleName, $roleDescription)
    {
        $role = Yii::$app->authManager->createRole($roleName);
        $role->description = $roleDescription;

        if (!Yii::$app->authManager->add($role)) {
            echo Yii::t('main', 'Could not create role: {roleName}', ['roleName' => $roleName]) . PHP_EOL;;
            return ExitCode::DATAERR;
        }

        return ExitCode::OK;
    }

    public function actionAttachRole($roleName, $login)
    {
        $role = Yii::$app->authManager->getRole($roleName);
        $user = Users::findOne(['login' => $login]);

        if (!$role instanceof Role) {
            echo Yii::t('main', 'Role not found: {roleName}', ['roleName' => $roleName]) . PHP_EOL;;
            return ExitCode::DATAERR;
        }

        if (!$role instanceof Role) {
            echo Yii::t('main', 'User not found: {0}', [$login]) . PHP_EOL;;
            return ExitCode::DATAERR;
        }

        Yii::$app->authManager->assign($role, $user->id);

        return ExitCode::OK;
    }
}