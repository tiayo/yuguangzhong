@extends('manage.layouts.app')

@section('title', '活动报名')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">活动管理</a></li>
    <li navValue="nav_1_1"><a href="#">活动报名</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <button type="button" class="btn btn-primary" onclick="location='{{ route('entry_add', ['activity_id' => $activity_id]) }}'">
                    添加报名
                </button>
            <header class="panel-heading">
                报名列表
            </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
                            <th>ID</th>
		                    <th>姓名</th>
		                    <th>活动</th>
		                    <th>电话</th>
		                    <th>邮箱</th>
                            <th>添加时间</th>
							<th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list['name'] }}</td>
                            <td>{{ $list->activity->name }}</td>
                            <td>{{ $list['phone'] }}</td>
                            <td>{{ $list['email'] }}</td>
                            <td>{{ $list['created_at'] }}</td>
                            <td>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('entry_update', ['activity_id' => $list['activity_id'], 'entry_id' => $list['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('entry_destroy', ['id' => $list['id'] ]) }}'">删除</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>
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

                window.location = '{{ route('category_search', ['keyword' => '']) }}/' + stripscript(keyword);

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
