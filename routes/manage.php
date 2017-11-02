<?php

//登录相关
$this->get('login', 'Auth\LoginController@showLoginForm')->name('manage.login');
$this->post('login', 'Auth\LoginController@login')->name('manage.login');
$this->get('logout', 'Auth\LoginController@logout')->name('manage.logout');

//登陆后才可以访问
$this->group(['middleware' => 'manage_auth'], function () {
    //后台首页
    $this->get('/', 'IndexController@index')->name('manage');

    //管理员才可以操作
    $this->group(['middleware' => 'admin'], function () {
        //会员相关
        $this->get('/manager/list/', 'ManagerController@listView')->name('manager_list');
        $this->get('/manager/list/{keyword}', 'ManagerController@listView')->name('manager_search');
        $this->get('/manager/update/{id}', 'ManagerController@updateView')->name('manager_update');
        $this->post('/manager/update/{id}', 'ManagerController@post');
        $this->get('/manager/destroy/{id}', 'ManagerController@destroy')->name('manager_destroy');

        //分类相关
        $this->get('/category/list/', 'CategoryController@listView')->name('category_list');
        $this->get('/category/list/{keyword}', 'CategoryController@listView')->name('category_search');
        $this->get('/category/add', 'CategoryController@addView')->name('category_add');
        $this->post('/category/add', 'CategoryController@post');
        $this->get('/category/update/{id}', 'CategoryController@updateView')->name('category_update');
        $this->post('/category/update/{id}', 'CategoryController@post');
        $this->get('/category/destroy/{id}', 'CategoryController@destroy')->name('category_destroy');
        $this->get('/category/refresh', 'CategoryController@refresh');

        //文章模块
        $this->get('/article/list/', 'ArticleController@listView')->name('article_list');
        $this->get('/article/search', 'ArticleController@search')->name('article_search');
        $this->get('/article/add', 'ArticleController@addView')->name('article_add');
        $this->post('/article/add', 'ArticleController@post');
        $this->get('/article/update/{id}', 'ArticleController@updateView')->name('article_update');
        $this->post('/article/update/{id}', 'ArticleController@post');
        $this->get('/article/destroy/{id}', 'ArticleController@destroy')->name('article_destroy');

        //活动模块
        $this->get('/activity/list/', 'ActivityController@listView')->name('activity_list');
        $this->get('/activity/list/{keyword}', 'ActivityController@listView')->name('activity_search');
        $this->get('/activity/add', 'ActivityController@addView')->name('activity_add');
        $this->post('/activity/add', 'ActivityController@post');
        $this->get('/activity/update/{id}', 'ActivityController@updateView')->name('activity_update');
        $this->post('/activity/update/{id}', 'ActivityController@post');
        $this->get('/activity/destroy/{id}', 'ActivityController@destroy')->name('activity_destroy');
        $this->get('/activity/status/{activity_id}/{status}', 'ActivityController@changeStatus')->name('activity_status');
    });
});