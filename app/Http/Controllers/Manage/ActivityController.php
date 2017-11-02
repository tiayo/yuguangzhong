<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activity;
    protected $request;

    public function __construct(ActivityService $activity, Request $request)
    {
        $this->activity = $activity;
        $this->request = $request;
    }

    /**
     * 记录列表
     *
     * @param null $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $num = config('site.list_num');

        $categories = $this->activity->get($num, $keyword);

        return view('manage.activity.list', [
            'lists' => $categories,
        ]);
    }

    /**
     * 添加视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView()
    {
        return view('manage.activity.add_or_update', [
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('activity_add'),
            'sign' => 'add',
        ]);
    }

    /**
     * 修改管理员视图
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function updateView($id)
    {
        try {
            $old_input = $this->request->session()->has('_old_input') ?
                session('_old_input') : $this->activity->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.activity.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('activity_update', ['id' => $id]),
            'sign' => 'update',
        ]);
    }

    public function changeStatus($activity_id, $status)
    {
        $this->activity->changeStatus($activity_id, $status);

        return redirect()->back();
    }

    /**
     * 添加/更新提交
     *
     * @param null $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function post($id = null)
    {
        $this->validate($this->request, [
            'name' => 'required',
            'start_time' => 'required|date',
            'sponsor' => 'required',
            'order' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|integer',
            'content' => 'required',
        ]);

        try {
            $this->activity->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('activity_list');
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        try {
            $this->activity->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('activity_list');
    }
}