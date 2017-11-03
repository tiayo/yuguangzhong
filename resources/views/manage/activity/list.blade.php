@extends('manage.layouts.app')

@section('title', '活动管理')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">活动管理</a></li>
    <li navValue="nav_1_1"><a href="#">活动管理</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <form class="form-inline" id="search_form">
                    <div class="form-group">
                        <label class="sr-only" for="search"></label>
                        <input type="text" class="form-control" id="search" name="keyword"
                               value="{{ Request::route('keyword') }}" placeholder="输入关键字" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="salesman_search">搜索</button>
                    <button type="button" class="btn btn-primary" style="float: right" onclick="location='{{ route('activity_add') }}'">
                        添加活动
                    </button>
                </form>
                <header class="panel-heading">
                    活动列表
                </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>活动</th>
		                    <th>类型</th>
		                    <th>开始时间</th>
		                    <th>结束时间</th>
		                    <th>参与人数</th>
		                    <th>可否预约</th>
		                    <th>状态</th>
		                    <th>创建时间</th>
                            <th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list['name'] }}</td>
                            <td>{{ config('site.activity_type')[$list['type']] }}</td>
                            <td>{{ $list['start_time'] }}</td>
                            <td>{{ $list['end_time'] }}</td>
                            <td>{{ $list['active_people'] }}</td>
                            <td>{{ config('site.activity_order')[$list['order']] }}</td>
                            <td>{{ config('site.activity_status')[$list['status']] }}</td>
                            <td>{{ $list['created_at'] }}</td><td>
                                @if ($list['order'] == 0)
                                    <button class="btn btn-info" type="button" onclick="location='{{ route('entry_list', ['id' => $list['id'] ]) }}'">报名列表</button>
                                @endif
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" id="btnGroupDrop1">
                                        更改状态 <span class="caret"></span>
                                    </button>
                                    <ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu">
                                        @foreach(config('site.activity_status') as $key => $activity_status)
                                            <li>
                                                <a href="{{ route('activity_status', ['activity_id' => $list['id'], 'status' => $key]) }}"
                                                   onClick="return confirm('是否确定进行操作？');">
                                                    {{ $activity_status }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('activity_update', ['id' => $list['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('activity_destroy', ['id' => $list['id'] ]) }}'">删除</button>
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
    {{--转换搜索链接--}}
    <script type="text/javascript">
        $(document).ready(function () {

            $('#search_form').submit(function () {

                var keyword = $('#search').val();

                if (stripscript(keyword) == '') {
                    $('#search').val('');
                    return false;
                }

                window.location = '{{ route('activity_search', ['keyword' => '']) }}/' + stripscript(keyword);

                return false;
            });

        });

        function stripscript(s)
        {
            var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
            var rs = "";
            for (var i = 0; i < s.length; i++) {
                rs = rs+s.substr(i, 1).replace(pattern, '');
            }
            return rs;
        }
    </script>
@endsection
