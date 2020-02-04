<?php

use yii\db\Migration;

/**
 * Class m200204_174934_insert_test_posts_in_table_posts
 */
class m200204_174934_insert_test_posts_in_table_posts extends Migration
{
    private $posts = [
        ['title' => 'Первый пост', 'content' => 'Контент первого поста'],
        ['title' => 'Второй пост', 'content' => 'Контент второго поста'],
        ['title' => 'Третий пост', 'content' => 'Контент третьего поста'],
        ['title' => 'Четвертый пост', 'content' => 'Контент четвертого поста'],
        ['title' => 'Пятый пост', 'content' => 'Контент пятого поста'],
    ];


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $currentTime = time();

        foreach ($this->posts as $index => $post) {
            $this->posts[$index]['is_visible'] = false;
            $this->posts[$index]['created_at'] = $currentTime;
            $this->posts[$index]['updated_at'] = $currentTime;
        }

        Yii::$app->db->createCommand()
            ->batchInsert('posts',
                [
                    'title',
                    'content',
                    'is_visible',
                    'created_at',
                    'updated_at'
                ],
                $this->posts
            )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('posts');
    }
}
