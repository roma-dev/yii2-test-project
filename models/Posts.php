<?php

namespace app\models;


class Posts extends base\Posts
{
    public static function getVisiblePost($id)
    {
        return Posts::findOne([
            'is_visible' => self::POST_VISIBLE,
            'id' => $id
        ]);
    }
}