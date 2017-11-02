<?php

namespace App\Services\Manage;

use App\Repositories\ActivityRespository;
use App\Services\ImageService;
use Exception;

class ActivityService
{
    use ImageService;
    
    protected $activity;

    public function __construct(ActivityRespository $activity)
    {
        $this->activity = $activity;
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
        $salesman = $this->activity->first($id);

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
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->activity->getSearch($num, $keyword);
        }

        return $this->activity->get($num);
    }

    /**
     * 获取需要的数据
     *
     * @param array ...$select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->activity->getSimple(...$select);
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
    public function changeStatus($activity_id, $status)
    {
        return $this->activity->update($activity_id, ['status' => $status]);
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
        $data['start_time'] = $post['start_time'];
        $data['sponsor'] = $post['sponsor'];
        $data['order'] = $post['order'];
        $data['type'] = $post['type'];
        $data['status'] = $post['status'];
        $data['content'] = $post['content'];

        empty($post['end_time']) ? true : $data['end_time'] = $post['end_time'];
        empty($post['active_people']) ? true : $data['active_people'] = $post['active_people'];
        empty($post['contractor']) ? true : $data['contractor'] = $post['contractor'];

        //保存图片(如果上传)
        if (!empty($post['picture'])) {
            $data['picture'] = $this->uploadImage($post['picture']);
        }

        //执行插入或更新
        return empty($id) ? $this->activity->create($data) : $this->activity->update($id, $data);
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
        return $this->activity->destroy($id);
    }
}