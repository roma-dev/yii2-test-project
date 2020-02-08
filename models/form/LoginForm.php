<?php

namespace app\models\form;

use app\models\base\Users;
use Yii;
use yii\base\Model;

/**
 * Class LoginForm
 * @package app\models\form
 *
 * @property string $login
 * @property string $password
 */
class LoginForm extends Model
{
    public $login;

    public $password;

    private $_user = null;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'min' => 3, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['login', 'validateLogin'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => \Yii::t('main', 'Login'),
            'status' => \Yii::t('main', 'Status'),
            'password' => \Yii::t('main', 'Password')
        ];
    }

    public function validateLogin($attribute)
    {
        if (!$this->hasErrors() && !($this->getUser() instanceof Users)) {
            $this->addError($attribute, Yii::t('main', 'User with such login not found'));
        }

        if (!$this->hasErrors() && $this->getUser()->status === Users::STATUS_CREATED) {
            $this->addError($attribute, Yii::t('main', 'You need to confirm your email'));
        }

        if (!$this->hasErrors() && $this->getUser()->status === Users::STATUS_BANNED) {
            $this->addError($attribute, Yii::t('main', 'A user with this login is banned'));
        }
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $isValid = Yii::$app->getSecurity()->validatePassword(
                $this->password,
                Yii::$app->getSecurity()->generatePasswordHash($this->password)
            );

            if (!$isValid) {
                $this->addError($attribute, Yii::t('main', 'Invalid password entered'));
            }
        }
    }

    public function login()
    {
        if ($this->validate() && $this->getUser() instanceof Users) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Users::findOne(['login' => $this->login]);
        }

        return $this->_user;
    }
}