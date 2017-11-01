@extends('manage.layouts.app')

@section('title', '添加/管理文章')

@section('style')
    @parent
    {{--编辑器--}}
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">文章管理</a></li>
    <li navValue="nav_0_2"><a href="#">添加/管理文章</a></li>
@endsection

@section('body')
    <div class="col-md-12">

        <!--错误输出-->
        <div class="form-group">
            <div class="alert alert-danger fade in @if(!count($errors) > 0) hidden @endif" id="alert_error">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <span>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </span>
            </div>
        </div>

        <section class="panel">
            <header class="panel-heading">
                添加/管理文章
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" enctype="multipart/form-data" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title" class="col-sm-2 col-sm-2 control-label">标题</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $old_input['title'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture" class="col-sm-2 col-sm-2 control-label">封面图片</label>
                        <div class="col-sm-3">
                            <input type="text" id="article_picture_input" class="form-control"  value="{{ $old_input['picture'] or ''}}" placeholder="上传封面图片...">
                            <input type="file" id="article_picture_file" style="margin-top: 1em;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="attribute" class="col-sm-2 col-sm-2 control-label">属性</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="attribute" name="attribute">
                                @foreach(config('site.article_attribute') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="col-sm-2 col-sm-2 control-label">分类</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="category_id" name="category_id">
                                {{--原栏目--}}
                                @if(!empty($old_input['category_id']))
                                    @foreach($categories as $list)
                                        @if($list['id'] == $old_input['category_id'])
                                            <option value="{{ $list['id'] }}">
                                                {{ $list['name'] }}
                                            </option>
                                            @php
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                @foreach($categories as $list)
                                    <option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="writer" class="col-sm-2 col-sm-2 control-label">作者</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="writer" name="writer" value="{{ $old_input['writer'] or Auth::guard('manager')->user()['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="abstract" class="col-sm-2 col-sm-2 control-label">摘要</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="abstract" name="abstract" placeholder="放空则自动截取...">{{ $old_input['abstract'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 col-sm-2 control-label">内容</label>
                        <div class="col-sm-10">
                            <script id="editor" type="text/plain" name="content">
                                {!! $old_input['content'] or '' !!}
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div  class="col-sm-2 col-sm-2 control-label">
                            <button class="btn btn-success" type="submit"><i class="fa fa-cloud-upload"></i> 确认提交</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $('#password').bind('input propertychange', function() {
                $(this).attr('name', 'password')
            });

            //input框change事件
            $('#article_picture_input').on('change', function () {
                $('#article_picture_input').attr('name', 'picture');
                $('#article_picture_file').attr('name', '');
            });
            //file框change时间
            $('#article_picture_file').on('change', function () {
                $('#article_picture_input').val($(this).val()).attr('name', '');
                $(this).attr('name', 'picture');
            })

            //开启编辑器
            UE.getEditor('editor')
        })
    </script>
@endsection
