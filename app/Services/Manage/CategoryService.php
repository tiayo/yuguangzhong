<?php

namespace App\Services\Manage;

use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
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
        $salesman = $this->category->first($id);

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
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->category->getSearch($num, $keyword);
        }

        return $this->category->get($num);
    }

    /**
     * 获取需要的数据(顶级栏目)
     *
     * @return mixed
     */
    public function getParent()
    {
        return $this->category->getParent();
    }

    /**
     * 获取需要的数据
     *
     * @param array ...$select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->category->getSimple(...$select);
    }

    /**
     * 获取指定栏目所有下级
     *
     * @param $category_id
     * @return bool|mixed
     */
    public function getCategoryChildren($category_id)
    {
        $categories = $this->printArray($this->tree($this->getSimple('*')->toArray()));

        return $this->getCategoryChildrenHandle($categories, $category_id);
    }

    /**
     * 获取指定栏目所有下级递归处理函数
     *
     * @param $categories
     * @param $category_id
     * @return bool|mixed
     */
    public function getCategoryChildrenHandle($categories, $category_id)
    {
        if (!is_array($categories)) {
            return false;
        }

        foreach ($categories as $category) {
            if ($category['id'] == $category_id) {
                return $category;
            }

            if (!isset($category['childs'])) {
                continue;
            }

            $this->getCategoryChildrenHandle($category['childs'], $category_id);
        }

        return false;
    }

    /**
     * 创建目录树.
     *
     * @param $items
     *
     * @return mixed
     */
    public function tree($items)
    {
        $childs = [];

        foreach ($items as &$item) {
            $childs[$item['parent_id']][] = &$item;
        }

        unset($item);

        foreach ($items as &$item) {
            if (isset($childs[$item['id']])) {
                $item['childs'] = $childs[$item['id']];
            }
        }

        return isset($childs[0]) ? $childs[0] : [];
    }

    /**
     * 处理侧边栏显示顺序.
     *
     * @param $tree
     *
     * @return array
     */
    public function printArray($tree)
    {
        foreach ($tree as $t) {
            $t['childs'] = isset($t['childs']) ? $t['childs'] : null; //No report index does not exist

            //子级栏目
            if ($t['parent_id'] != 0 && $t['childs'] == '') {
                $t['name'] = '--'.$t['name'];
                $result[] = $t;
            }
            //父级栏目
            else {
                $children = [];

                //二级目录顶级目录加前缀
                if ($t['parent_id'] != 0) {
                    $t['name'] = '--'.$t['name'];
                    $t['childs'] = $this->addPrefix($t['childs'], '--');
                }

                $result[] = $t;

                if ($t['childs']) {
                    $children = $this->printArray($t['childs']);
                }
                $result = array_merge($result, $children);
            }
        }

        return $result ?? [];
    }

    /**
     * 无限极添加前缀
     *
     * @param $array
     * @param $prefix
     *
     * @return array|string
     */
    public function addPrefix($array, $prefix)
    {
        foreach ($array as $key => $value) {
            $value['name'] = $prefix.$value['name'];
            $result[$key] = $value;
            if (isset($value['childs'])) {
                $result[$key]['childs'] = $this->addPrefix($value['childs'], $prefix);
            }
        }
        return $result ?? [];
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
        $data['name'] = $post['name'];
        $data['parent_id'] = $post['parent_id'];
        $data['view'] = isset($post['view']) ? 1 : 0;

        empty($post['list_templet']) ? true : $data['list_templet'] = $post['list_templet'];
        empty($post['article_templet']) ? true : $data['article_templet'] = $post['article_templet'];

        //创建操作
        if (empty($id)) {
            return $this->category->create($data);
        }

        //更新操作
        $this->category->update($id, $data);

        //如果是：顶级栏目，更新下级栏目
        if (!isset($post['modified_children'])) {
            return true;
        }

        //构造批量更新数组
        $update['view'] = $data['view'];
        empty($data['list_templet']) ? true : $update['list_templet'] = $data['list_templet'];
        empty($data['article_templet']) ? true : $update['article_templet'] = $data['article_templet'];

        return $this->updateChildren($this->getCategoryChildren($id)['childs'], $update);
    }

    /**
     * 批量更新下级
     *
     * @param $categories
     * @param $update
     * @return bool
     */
    public function updateChildren($categories, $update)
    {
        foreach ($categories as $category) {
            $this->category->update($category['id'], $update);
            if (isset($category['childs'])) {
                $this->updateChildren($category['childs'], $update);
            }
        }

        return true;
    }

    /**
     * 判断分类是否为顶级
     *
     * @param $id
     * @return bool
     */
    public function isParent($id)
    {
        if ($this->validata($id)['parent_id'] == 0) {
            return true;
        }

        return false;
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
        return $this->category->destroy($id);
    }
}