<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\ActivityService;
use App\Services\Manage\EntryService;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    protected $entry, $request, $activity;

    public function __construct(EntryService $entry, Request $request, ActivityService $activity)
    {
        $this->entry = $entry;
        $this->request = $request;
        $this->activity = $activity;
    }

    /**
     * 记录列表
     *
     * @param null $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($activity_id)
    {
        $categories = $this->entry->get($activity_id);

        return view('manage.entry.list', [
            'lists' => $categories,
            'activity_id' => $activity_id,
        ]);
    }

    /**
     * 添加视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView($activity_id)
    {
        $activitiy = $this->activity->first($activity_id);

        return view('manage.entry.add_or_update', [
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('entry_add', ['activity_id' => $activity_id]),
            'sign' => 'add',
            'activitiy' => $activitiy,
        ]);
    }

    /**
     * 修改管理员视图
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function updateView($activity_id, $entry_id)
    {
        $entry = $this->entry->first($entry_id);

        $activitiy = $this->activity->first($activity_id);

        try {
            $old_input = $this->request->session()->has('_old_input') ?
                session('_old_input') : $entry;
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.entry.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('entry_update', ['activity_id' => $activity_id,'entry_id' => $entry_id]),
            'sign' => 'update',
            'activitiy' => $activitiy,
        ]);
    }

    public function changeStatus($entry_id, $status)
    {
        $this->entry->changeStatus($entry_id, $status);

        return redirect()->back();
    }

    /**
     * 添加/更新提交
     *
     * @param null $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function post($activity_id, $id = null)
    {
        $this->validate($this->request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        //添加时不中验证
        if (empty($id)) {
            $this->validate($this->request, [
                'activity_id' => 'required|integer',
                'phone' => 'unique:entries',
            ]);
        }

        try {
            $this->entry->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('entry_list', ['activity_id' => $activity_id]);
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
            $this->entry->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('entry_list');
    }
}