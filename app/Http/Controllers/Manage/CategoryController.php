<?php

namespace App\Http\Controllers\Manage;

use App\Category;
use App\Http\Controllers\Controller;
use App\Services\Manage\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $request;

    public function __construct(CategoryService $category, Request $request)
    {
        $this->category = $category;
        $this->request = $request;
    }

    /**
     * 记录列表
     *
     * @param null $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView()
    {
        $categories = $this->category->printArray(
            $this->category->tree(
                $this->category->getSimple('*')->toArray()
            )
        );

        return view('manage.category.list', [
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
        $categories = $this->category->printArray(
            $this->category->tree(
                $this->category->getSimple('*')->toArray()
            )
        );

        return view('manage.category.add_or_update', [
            'lists' => $categories,
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('category_add'),
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
        $categories = $this->category->printArray(
            $this->category->tree(
                $this->category->getSimple('*')->toArray()
            )
        );

        try {
            $old_input = $this->request->session()->has('_old_input') ?
                session('_old_input') : $this->category->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.category.add_or_update', [
            'lists' => $categories,
            'old_input' => $old_input,
            'url' => Route('category_update', ['id' => $id]),
            'sign' => 'update',
        ]);
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
            'parent_id' => 'required|integer',
        ]);

        try {
            $this->category->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('category_list');
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
            $this->category->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('category_list');
    }

    /**
     * 刷新所有链接（上线删除）
     *
     * @return string
     */
    public function refresh()
    {
        foreach (Category::get() as $category) {
            $data['link'] = $this->category->generateCategoryLink($category['id']);
            Category::where('id', $category['id'])->update($data);
        }

        return 'ssd';
    }
}