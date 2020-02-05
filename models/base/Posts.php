<?php

namespace app\models\base;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Posts
 * @package app\models\base
 *
 * @property $id integer
 * @property $title string
 * @property $content string
 * @property $is_visible bool
 * @property $created_at integer
 * @property $updated_at integer
 * @property $published_at integer
 */
class Posts extends ActiveRecord
{
    public function rules()
    {
        return [
            ['title', 'required'],
            [['title', 'content'], 'string'],
            [['published_at', 'created_at', 'updated_at'], 'integer'],
            ['is_visible', 'boolean'],
            ['title', 'string', 'max' => 255]
        ];
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

    public static function tableName()
    {
        return 'posts';
    }

    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('main', 'ID Post'),
            'title' => \Yii::t('main', 'Post title'),
            'content' => \Yii::t('main', 'Post content'),
            'is_visible' => \Yii::t('main', 'Is the post visible'),
            'created_at' => \Yii::t('main', 'Creation date'),
            'updated_at' => \Yii::t('main', 'Update date'),
            'published_at' => \Yii::t('main', 'Publication Date'),
        ];
    }
}