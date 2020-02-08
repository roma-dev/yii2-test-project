<?php

namespace app\models\base;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class Users
 * @package app\models\base
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends ActiveRecord implements IdentityInterface
{
    const STATUS_CREATED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_BANNED = 2;

    public static function tableName()
    {
        return 'users';
    }


   public function beforeSave($insert)
   {
       if ($this->isNewRecord) {
           $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
       }
       return parent::beforeSave($insert);
   }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['login', 'email', 'password'], 'required'],
            [['login', 'email', 'password'], 'string', 'max' => 255],
            ['login', 'unique'],
            ['email', 'unique'],
            ['email', 'email'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_CREATED],
            ['status', 'in', 'range' => [
                self::STATUS_CREATED,
                self::STATUS_CONFIRMED,
                self::STATUS_BANNED
            ]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('main', 'ID Users'),
            'login' => \Yii::t('main', 'Login'),
            'email' => \Yii::t('main', 'Email'),
            'password' => \Yii::t('main', 'Password'),
            'status' => \Yii::t('main', 'Status'),
            'created_at' => \Yii::t('main', 'Creation date'),
            'updated_at' => \Yii::t('main', 'Update date'),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
    }
}