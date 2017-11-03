<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\ActivityService;
use App\Services\Manage\EntryService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activity, $request, $entry;

    public function __construct(ActivityService $activity, Request $request, EntryService $entry)
    {
        $this->activity = $activity;
        $this->request = $request;
        $this->entry = $entry;
    }

    public function listView($type, $status)
    {
        $num =config('site.list_num');

        $activities = $this->activity->getList($num, $type, $status);

        return view('home.activity.list', [
            'activities'=> $activities,
        ]);
    }

    /**
     * 显示活动详情页
     *
     * @param $activity_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($activity_id)
    {
        $activity = $this->activity->first($activity_id);

        return view('home.activity.view', [
            'activity' => $activity,
            'activity_id' => $activity_id,
        ]);
    }

    /**
     * 活动详情页提交活动报名
     *
     * @param $activity_id
     * @return $this
     */
    public function entryPost($activity_id)
    {
        $this->validate($this->request, [
            'name' => 'required',
            'phone' => 'required|unique:entries',
            'captcha' => 'required'
        ]);

        $post = $this->request->all();

        //验证验证码
        if ($post['captcha'] != $this->request->session()->pull('entry_captcha')) {
            return redirect()->back()->withErrors('验证码错误');
        }


        if (!empty($post['email'])) {
            $this->validate($this->request, [
                'email' => 'email',
            ]);
        }

        $post['activity_id'] = $activity_id;

        $this->entry->updateOrCreate($post);

        return redirect()->back()->withErrors('报名成功！稍后您可能会接到通知！');
    }
}