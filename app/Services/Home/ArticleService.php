<?php

namespace App\Services\Home;

use App\Repositories\ArticleRepository;
use App\Services\Manage\ArticleService as Sevice;

class ArticleService
{
    protected $article, $service;

    public function __construct(ArticleRepository $article, Sevice $service, CategoryService $category)
    {
        $this->article = $article;
        $this->service = $service;
        $this->category = $category;
    }

    /**
     * 根据条件调用文章
     *
     * @param $category_id
     * @param $limit
     * @param int $skip
     * @param null $article_attribute
     * @param int $picture
     * @return mixed
     */
    public function get($category_id, $limit, $skip = 0, $article_attribute = null, $picture = 0)
    {
        if ($category_id === 0) {
            $category_array = $this->category->getSimple('id')->toArray();
        } else {
            $category_children = $this->category->getCategoryChildren($category_id);
            $category_array = array_merge($this->service->getCategoryID($category_children['childs'] ?? []), [(int) $category_id]);
        }

        //构造条件
        ($article_attribute !== null) ? $where[] = ['attribute', $article_attribute] : true;

        //获取
        return $this->article->selectGetIndex($where ?? [], $category_array, $limit, $skip, $picture, '*');
    }

    /**
     * 分页获取
     *
     * @param $category_id
     * @param $num
     * @param null $article_attribute
     * @param int $picture
     * @return mixed
     */
    public function selectGetList($category_id, $num, $article_attribute = null, $picture = 0)
    {
        if ($category_id === 0) {
            $category_array = $this->category->getSimple('id')->toArray();
        } else {
            $category_children = $this->category->getCategoryChildren($category_id);
            $category_array = array_merge($this->service->getCategoryID($category_children['childs'] ?? []), [(int) $category_id]);
        }

        //构造条件
        ($article_attribute !== null) ? $where[] = ['attribute', $article_attribute] : true;

        return $this->article->selectGetList($where ?? [], $category_array, $num, $picture, '*');
    }

    public function first($article_id)
    {
        return $this->service->validata($article_id);
    }

    public function preArticle($article_id, $category_id)
    {
        return $this->article->selectFirst([
            ['id', '<', $article_id],
            ['category_id', $category_id]
        ], '*');
    }

    public function nextArticle($article_id, $category_id)
    {
        return $this->article->selectFirst([
            ['id', '>', $article_id],
            ['category_id', $category_id]
        ], '*');
    }
}