<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public function rules()
    {
        return [
            ['title', 'require'],
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
            'created_at' => \Yii::t('main', 'ID Post'),
            'updated_at' => \Yii::t('main', 'ID Post'),
            'published_at' => \Yii::t('main', 'ID Post'),
        ];
    }
}