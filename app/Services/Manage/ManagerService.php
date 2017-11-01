<?php

namespace App\Services\Manage;

use App\Repositories\ManagerRepository;
use App\Services\ImageService;
use Exception;

class ManagerService
{
    use ImageService;

    protected $manager;

    public function __construct(ManagerRepository $manager)
    {
        $this->manager = $manager;
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
        $salesman = $this->manager->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        return $salesman;
    }

    /**
     * 获取需要的数据
     *
     * @return mixed
     */
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->manager->getSearch($num, $keyword);
        }

        return $this->manager->get($num);
    }

    /**
     * 更新
     *
     * @param $post
     * @param null $id
     * @return mixed
     */
    public function update($post, $id)
    {
        //统计数据
        $data['name'] = $post['name'];
        $data['email'] = $post['email'];

        empty($post['phone']) ? true : $data['phone'] = $post['phone'];
        empty($post['address']) ? true : $data['address'] = $post['address'];
        empty($post['password']) ? true : $data['password'] = bcrypt($post['password']);

        if (isset($post['avatar']))
        {
            $data['avatar'] = $this->uploadImage($post['avatar']);
        }
        
        //执行插入或更新
        return $this->manager->update($id, $data);
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
     * 删除管理员
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        //验证是否可以操作当前记录
        $this->validata($id)->toArray();

        //执行删除manager表
        return $this->manager->destroy($id);
    }

    /**
     * 按需求统计
     *
     * @param $where
     * @return mixed
     */
    public function count($where){
        return $this->manager->count($where);
    }
}