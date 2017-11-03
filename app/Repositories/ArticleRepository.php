<?php

namespace App\Repositories;

use App\Article;

class ArticleRepository
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * 创建记录
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->article->create($data);
    }

    /**
     * 获取所有显示记录（带分页）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num)
    {
        return $this->article
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取所有显示记录(不带分页)
     *
     * @param array ...$select
     * @return mixed
     */
    public function getSimple(...$select)
    {
        return $this->article
            ->select($select)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取显示的搜索结果
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword, $category_id)
    {
        if (empty($category_id)) {
            return $this->article
                ->where(function ($query) use ($keyword) {
                    $query->where('articles.title', 'like', "%$keyword%");
                })
                ->orderBy('id', 'desc')
                ->paginate($num);
        }

        return $this->article
            ->whereIn('category_id', $category_id)
            ->where(function ($query) use ($keyword) {
                $query->where('articles.title', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取单条记录
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->article->find($id);
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->article
            ->where('id', $id)
            ->delete();
    }

    /**
     * 获取单条记录（带where和select）
     *
     * @param $where
     * @param array ...$select
     * @return mixed
     */
    public function selectFirst($where, ...$select)
    {
        return $this->article
            ->select($select)
            ->where($where)
            ->first();
    }

    /**
     * 获取指定记录（带where和select）
     *
     * @param $where
     * @param array ...$select
     * @return mixed
     */
    public function selectGet($where, ...$select)
    {
        return $this->article
            ->select($select)
            ->where($where)
            ->get();
    }

    /**
     * 前段获取文章方法
     *
     * @param $where [附加条件]
     * @param $category_array [栏目范围]
     * @param $number [读取条数]
     * @param $picture [是否限制图片不为空]
     * @param array ...$select [获取字段]
     * @return mixed
     */
    public function selectGetIndex($where, $category_array, $limit, $skip, $picture, ...$select)
    {
        $query = $this->article
            ->select($select)
            ->whereIn('category_id', $category_array);

        if(!empty($where)) {
            $query->where($where);
        }

        if ($picture) {
            $query->whereNotNull('picture');
        }

        return $query->skip($skip)
            ->take($limit)
            ->get();
    }

    public function selectGetList($where, $category_array, $num, $picture, ...$select)
    {
        $query = $this->article
            ->select($select)
            ->whereIn('category_id', $category_array);

        if(!empty($where)) {
            $query->where($where);
        }

        if ($picture) {
            $query->whereNotNull('picture');
        }

        return $query
            ->paginate($num);
    }

    /**
     * 更新记录
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->article
            ->where('id', $id)
            ->update($data);
    }

    /**
     * 更新记录
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateWhere($where, $data)
    {
        return $this->article
            ->where($where)
            ->update($data);
    }

    /**
     * 获取符合要求的文章
     *
     * @param $type
     * @param $limit
     * @return mixed
     */
    public function getByGroup($group, $limit)
    {
        if ($group == 0) {
            return $this->article
                ->where('group', '>=', $group)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        }

        return $this->article
            ->where('group', $group)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}