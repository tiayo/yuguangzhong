<?php

namespace App\Repositories;

use App\Manager;

class ManagerRepository
{
    protected $manager;

    public function __construct(manager $manager)
    {
        $this->manager = $manager;
    }

    public function create($data)
    {
        return $this->manager->create($data);
    }

    /**
     * 获取所有显示记录
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num)
    {
        return $this->manager
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取显示的搜索结果
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword)
    {
        return $this->manager
            ->where(function ($query) use ($keyword) {
                $query->where('managers.name', 'like', "%$keyword%")
                    ->orwhere('managers.email', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    public function first($id)
    {
        return $this->manager->find($id);
    }

    public function destroy($id)
    {
        //删除关联
        $this->manager
            ->find($id)
            ->profile()
            ->delete();

        //删除manager表
        return $this->manager
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->manager
            ->select($select)
            ->where($where)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->manager
            ->where('id', $id)
            ->update($data);
    }

    public function count($where)
    {
        return $this->manager
            ->where($where)
            ->count();
    }
}