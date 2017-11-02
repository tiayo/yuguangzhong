<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\ArticleService;
use App\Services\Manage\CategoryService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $article, $request, $category;

    public function __construct(ArticleService $article, Request $request, CategoryService $category)
    {
        $this->article = $article;
        $this->request = $request;
        $this->category = $category;
    }

    /**
     * 记录列表
     *
     * @param null $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView()
    {
        $num = config('site.list_num');

        $articles = $this->article->get($num);

        $categories = $this->category->printArray(
            $this->category->tree(
                $this->category->getSimple('*')->toArray()
            )
        );

        return view('manage.article.list', [
            'lists' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * 搜索
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $num = config('site.list_num');

        $articles = $this->article->getSearch($num, $this->request->all());

        $categories = $this->category->printArray(
            $this->category->tree(
                $this->category->getSimple('*')->toArray()
            )
        );

        return view('manage.article.list', [
            'lists' => $articles,
            'categories' => $categories,
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

        return view('manage.article.add_or_update', [
            'categories' => $categories,
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('article_add'),
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
                session('_old_input') : $this->article->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.article.add_or_update', [
            'categories' => $categories,
            'old_input' => $old_input,
            'url' => Route('article_update', ['id' => $id]),
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
            'title' => 'required',
            //'picture' => 'file|image',
            'attribute' => 'required|integer|min:0|max:4',
            'category_id' => 'required|integer',
            'writer' => 'required',
        ]);

        try {
            $this->article->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('article_list');
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
            $this->article->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('article_list');
    }
}