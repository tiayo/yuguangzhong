<?php

$this->get('/', 'IndexController@index')->name('home.index');

$this->get('/category/{type}/{category_id}', 'CategoryController@listView')->name('home.category_list');

$this->get('/article/{type}/{category_id}', 'ArticleController@view')->name('home.article_view');

$this->get('/activity/view/{activity_id}', 'ActivityController@view')->name('home.activity_view');
$this->get('/activity/list/{type}/{status}', 'ActivityController@listView')->name('home.activity_list');

$this->post('/encry/add/{activity_id}', 'ActivityController@entryPost')->name('home.entry_add');
