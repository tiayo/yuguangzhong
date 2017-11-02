<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\ArticleService;
use App\Services\Home\CategoryService;

class ArticleController extends Controller
{
    protected $category, $article;

    public function __construct(CategoryService $category, ArticleService $article)
    {
        $this->category = $category;
        $this->article = $article;
    }

    public function view($type, $article_id)
    {
        //当前文章内容
        $article = $this->article->first($article_id);

        //当前文章分类
        $category = $this->category->first($article['category_id']);

        //所属分类的上级分类的所有子分类
        $childrens = $this->category->getCategoryArray($this->category->getCategoryChildren($category['parent_id'])['childs']);

        //上一篇
        $pre_article = $this->article->preArticle($article_id, $article['category_id']);

        //下一篇
        $next_article = $this->article->nextArticle($article_id, $article['category_id']);

        return view('home.article.'.$type, [
            'category' => $category,
            'childrens' => $childrens,
            'article' => $article,
            'pre_article' => $pre_article ?? ['id' => $article_id, 'title' => '没有了'],
            'next_article' => $next_article ?? ['id' => $article_id, 'title' => '没有了'],
        ]);
    }
}