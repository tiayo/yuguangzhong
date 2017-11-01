<?php

namespace App\Repositories;

use App\OrderDetail;

class OrderDetailRepository
{
    protected $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * 创建记录
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->orderDetail->create($data);
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->orderDetail
            ->where('id', $id)
            ->delete();
    }
}
