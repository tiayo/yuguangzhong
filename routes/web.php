<?php

$this->get('/', 'IndexController@index')->name('home.index');
$this->get('/category/{type}/{category_id}', 'CategoryController@listView')->name('home.category_list');
$this->get('/article/{type}/{category_id}', 'ArticleController@view')->name('home.article_view');