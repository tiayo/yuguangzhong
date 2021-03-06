<?php

namespace App\Services\Manage;

use App\Repositories\ArticleRepository;
use App\Services\ImageService;
use Exception;

class ArticleService
{
    use ImageService;

    protected $article, $category;

    public function __construct(ArticleRepository $article, CategoryService $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /**
     * 通过id验证记录是否存在以及是否有操作权限
     * 通过：返回该记录
     * 否则：抛错
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function validata($id)
    {
        $salesman = $this->article->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        return $salesman;
    }

    /**
     * 获取需要的数据
     *
     * @param int $num
     * @param null $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num = 10000)
    {
        return $this->article->get($num);
    }

    public function getSearch($num, $post)
    {
        $keyword = $post['keyword'] ?? '';

        $category_id = $post['category_id'] ?? [];

        if (!empty($category_id)) {
            $category_children = $this->category->getCategoryChildren($category_id);
            $category_id = array_merge($this->getCategoryID($category_children['childs'] ?? []), [$category_id]);
        }

        return $this->article->getSearch($num, $keyword, $category_id);
    }

    /**
     * 获取分类数组中所有分类id
     *
     * @param $categories
     * @return mixed
     */
    public function getCategoryID($categories, &$result = [])
    {
        foreach ($categories as $category) {
            $result[] = $category['id'];
            if (isset($category['childs'])) {
                $this->getCategoryID($category['childs'], $result);
            }
        }

        return $result;
    }


    /**
     * 获取需要的数据
     *
     * @param array ...$select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->article->getSimple(...$select);
    }

    /**
     * 查找指定id的用户
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->validata($id);
    }

    /**
     * 更新或编辑
     *
     * @param $post
     * @param null $id
     * @return mixed
     */
    public function updateOrCreate($post, $id = null)
    {
        //构造数据
        $data['title'] = $post['title'];
        $data['attribute'] = $post['attribute'];
        $data['category_id'] = $post['category_id'];
        $data['writer'] = $post['writer'];
        $data['content'] = $post['content'];
        $data['abstract'] = $post['abstract'] ?? mb_substr(strip_tags($post['content']), 0, 150);;

        //保存图片(如果上传)
        if (!empty($post['picture'])) {
            $data['picture'] = $this->uploadImage($post['picture']);
        }

        //执行插入或更新
        empty($id) ? $id = $this->article->create($data)->id : $this->article->update($id, $data);

        //link
        $update['link'] = $this->category->generateArticleLink($this->category->first($data['category_id']), $id, 'force');

        return $this->article->update($id, $update);
    }

    /**
     * 删除管理员
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        //验证是否可以操作当前记录
        $this->validata($id)->toArray();

        //执行删除
        return $this->article->destroy($id);
    }
}