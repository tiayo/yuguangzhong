@extends('manage.layouts.app')

@section('title', '文章管理')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">文章管理</a></li>
    <li navValue="nav_0_2"><a href="#">文章管理</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <form class="form-inline" id="search_form" action="{{ route('article_search') }}">
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                            根据栏目查看 <span class="caret"></span>
                        </button>
                        <ul role="menu" class="dropdown-menu">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('article_search', ['category_id' => $category['id']]) }}">
                                        {{ $category['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="search"></label>
                        <input type="text" class="form-control" id="search" name="keyword"
                               value="{{ Request::get('keyword') }}" placeholder="输入关键字" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="salesman_search">搜索</button>
                    <button type="button" class="btn btn-primary" style="float: right" onclick="location='{{ route('article_add') }}'">
                        添加文章
                    </button>
                </form>
                <header class="panel-heading">
                    文章列表
                </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>标题</th>
		                    <th>属性</th>
		                    <th>分类</th>
		                    <th>作者</th>
		                    <th>更新时间</th>
		                    <th>创建时间</th>
                            <th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list['title'] }}</td>
                            <td>{{ config('site.article_attribute')[$list['attribute']] }}</td>
                            <td>{{ $list->category->name }}</td>
                            <td>{{ $list['writer'] }}</td>
                            <td>{{ $list['updated_at'] }}</td>
                            <td>{{ $list['created_at'] }}</td><td>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('article_update', ['id' => $list['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('article_destroy', ['id' => $list['id'] ]) }}'">删除</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>

               {{ $lists->links() }}
            </div>
    	</section>
    </div>
</div>
@endsection

@section('script')
    @parent
@endsection
