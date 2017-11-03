<?php

namespace App\Services\Manage;

use App\Repositories\EntryRespository;
use Exception;

class EntryService
{
    protected $entry;

    public function __construct(EntryRespository $entry)
    {
        $this->entry = $entry;
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
        $salesman = $this->entry->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        throw_if(can('control'), Exception::class, '没有权限！', 403);

        return $salesman;
    }

    /**
     * 获取需要的数据
     *
     * @param int $num
     * @param null $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($activity_id)
    {
        return $this->entry->get($activity_id);
    }

    /**
     * 获取需要的数据
     *
     * @param array ...$select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->entry->getSimple(...$select);
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
     * 修改状态
     *
     * @param $order_id
     * @param $status
     * @return mixed
     */
    public function changeStatus($entry_id, $status)
    {
        return $this->entry->update($entry_id, ['status' => $status]);
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
        $data['phone'] = $post['phone'];

        empty($post['email']) ? true : $data['email'] = $post['email'];
        empty($post['remark']) ? true : $data['remark'] = $post['remark'];

        //保存图片(如果上传)
        if (empty($id)) {
            $data['activity_id'] = $post['activity_id'];
        }

        //执行插入或更新
        return $data = empty($id) ? $this->entry->create($data) : $this->entry->update($id, $data);
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
        return $this->entry->destroy($id);
    }
}