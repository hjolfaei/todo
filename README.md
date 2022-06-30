# Todo API Package for Laravel
This package add todo ability to your app

## Installation

``` bash
composer require hjolfaei/todo
```
``` bash
# migrate database
php artisan migrate
```

## Instructions

To use this package you most create "token" column inside your "users" table and save your user token inside created column. then use that token for header authorization. for more information see this url in your app after installing package
``` bash
http://APP_URL/todo
```

## API Endpoints

``` bash
#Fill test data:
/todo/api/v1/fill

#All tasks:
/todo/api/v1/tasks

#All labels:
/todo/api/v1/labels

#Special task:
/todo/api/v1/tasks/task-id
#methods: Info:GET Create:POST Update:UPDATE Delete:DELETE

#Special label:<br>
/todo/api/v1/labels/label-id
#methods: Info:GET Create:POST Update:UPDATE
```
