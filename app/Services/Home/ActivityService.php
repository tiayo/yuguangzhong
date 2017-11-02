<?php

namespace App\Services\Home;

use App\Repositories\ActivityRespository;
use App\Services\Manage\ActivityService as Sevice;
use Exception;

class ActivityService
{
    protected $activity, $service;

    public function __construct(ActivityRespository $activity, Sevice $service)
    {
        $this->activity = $activity;
        $this->service = $service;
    }

    public function get($limit, $type = null, $status = null, $order = null)
    {
        return $this->activity->selectGetIndex($limit, $type, $status, $order);
    }
}