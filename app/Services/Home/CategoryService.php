<?php

namespace App\Services\Home;

use App\Repositories\CategoryRepository;
use App\Services\Manage\CategoryService as Sevice;
use Exception;

class CategoryService
{
    protected $category, $service;

    public function __construct(CategoryRepository $category, Sevice $service)
    {
        $this->category = $category;
        $this->service = $service;
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

    public function getCategoryChildren($category_id)
    {
        return $this->service->getCategoryChildren($category_id);
    }

    public function getSimple(...$select)
    {
        return $this->category->getSimple(...$select);
    }
}