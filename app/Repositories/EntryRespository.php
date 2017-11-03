<?php

namespace App\Repositories;

use App\Entry;

class EntryRespository
{
    protected $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    /**
     * 创建记录
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->entry->create($data);
    }

    /**
     * 获取所有显示记录（带分页）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($activity_id)
    {
        return $this->entry
            ->where('activity_id', $activity_id)
            ->orderBy('id', 'desc')
            ->paginate(config('site.list_num'));
    }

    /**
     * 获取所有显示记录(不带分页)
     *
     * @param array ...$select
     * @return mixed
     */
    public function getSimple(...$select)
    {
        return $this->entry
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
    public function getSearch($num, $keyword)
    {
        return $this->entry
            ->where(function ($query) use ($keyword) {
                $query->where('activities.name', 'like', "%$keyword%");
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
        return $this->entry->find($id);
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->entry
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
        return $this->entry
            ->select($select)
            ->where($where)
            ->first();
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
        return $this->entry
            ->where('id', $id)
            ->update($data);
    }
}