<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\ArticleService;
use App\Services\Home\CategoryService;

class CategoryController extends Controller
{
    protected $category, $article;

    public function __construct(CategoryService $category, ArticleService $article)
    {
        $this->category = $category;
        $this->article = $article;
    }

    public function listView($type, $category_id)
    {
        $category = $this->category->first($category_id);

        $childrens = $this->category->getCategoryArray(
            $this->category->getCategoryChildren($category_id)['childs'] ??
            $this->category->getCategoryChildren($category['parent_id'])['childs']
        );

        $articles = $this->article->selectGetList($category_id, config('site.list_num'));

        return view('home.category.'.$type, [
            'category' => $category,
            'childrens' => $childrens,
            'articles' => $articles,
        ]);
    }
}