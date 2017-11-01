<?php

namespace App\Repositories;

use App\Attribute;

class AttributeRepository
{
    protected $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function create($data)
    {
        return $this->attribute->create($data);
    }

    /**
     * 获取所有显示记录
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num, $category_id)
    {
        return $this->attribute
            ->orderBy('id', 'desc')
            ->where('category_id', $category_id)
            ->paginate($num);
    }

    /**
     * 获取所有显示记录(简易)
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->attribute
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
        return $this->attribute
            ->where(function ($query) use ($keyword) {
                $query->where('attributes.name', 'like', "%$keyword%")
                    ->orwhere('attributes.email', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }
    
    public function first($id)
    {
        return $this->attribute->find($id);
    }

    public function destroy($id)
    {
        return $this->attribute
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->attribute
            ->select($select)
            ->where($where)
            ->first();
    }

    public function selectGet($where, ...$select)
    {
        return $this->attribute
            ->select($select)
            ->where($where)
            ->get();
    }

    public function update($id, $data)
    {
        return $this->attribute
            ->where('id', $id)
            ->update($data);
    }

    public function count($where)
    {
        return $this->attribute
            ->where($where)
            ->count();
    }
}