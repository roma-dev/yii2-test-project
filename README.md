<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

* Создайте базу данных и укажите настройки в файле `config/db.php`
* Запустите миграции
~~~
php yii migrate
~~~
* Запустите миграции для RBAC
~~~
php yii migrate --migrationPath=@yii/rbac/migrations
~~~

* Создайте пользователя 
~~~
php yii user/create admin admin@example.com password 1
~~~

* Создайте роль админа 
~~~
php yii user/create-role admin 'Роль админа'
~~~

* Привяжите роль админа к пользователю
~~~
php yii user/attach-role admin admin
~~~

* Вход в админку [/admin/dashboard/login](/admin/dashboard/login)