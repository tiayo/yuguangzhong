@extends('manage.layouts.app')

@section('title', '添加/管理活动')

@section('style')
    @parent
    {{--编辑器--}}
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
    {{--时间控件--}}
    <link href="https://cdn.bootcss.com/flatpickr/2.5.6/flatpickr.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.bootcss.com/flatpickr/2.5.6/flatpickr.js"></script>
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">活动管理</a></li>
    <li navValue="nav_1_1"><a href="#">添加/管理活动</a></li>
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
                添加/管理活动
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" enctype="multipart/form-data" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">活动名称</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 col-sm-2 control-label">活动类型</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="type" name="type">
                                @if (isset($old_input['type']))
                                    <option value="{{ $old_input['type'] }}">{{ config('site.activity_type')[$old_input['type']] }}</option>
                                @endif
                                @foreach(config('site.activity_type') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
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
                        <label for="start_time" class="col-sm-2 col-sm-2 control-label">开始时间</label>
                        <div class="col-sm-3">
                            <input type="hidden" value="date">
                            <input type="text" class="form-control" id="start_time" name="start_time"  value="{{$old_input['start_time']}}" placeholder="Select Time.." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_time" class="col-sm-2 col-sm-2 control-label">结束时间</label>
                        <div class="col-sm-3">
                            <input type="hidden" value="date">
                            <input type="text" class="form-control" id="end_time" name="end_time"  value="{{$old_input['end_time']}}" placeholder="Select Time.." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sponsor" class="col-sm-2 col-sm-2 control-label">主办方</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="sponsor" name="sponsor" required>{{ $old_input['sponsor'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contractor" class="col-sm-2 col-sm-2 control-label">承办方</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="contractor" name="contractor">{{ $old_input['contractor'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order" class="col-sm-2 col-sm-2 control-label">报名</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="order" name="order">
                                @if (isset($old_input['order']))
                                    <option value="{{ $old_input['order'] }}">{{ config('site.activity_order')[$old_input['order']] }}</option>
                                @endif
                                @foreach(config('site.activity_order') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="active_people" class="col-sm-2 col-sm-2 control-label">报名人数</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="active_people" name="active_people"
                                   placeholder="需要报名功能时填写" value="{{ $old_input['active_people'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 col-sm-2 control-label">状态</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="status" name="status">
                                @if (isset($old_input['status']))
                                    <option value="{{ $old_input['status'] }}">{{ config('site.activity_status')[$old_input['status']] }}</option>
                                @endif
                                @foreach(config('site.activity_status') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 col-sm-2 control-label">活动介绍</label>
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
            UE.getEditor('editor');

            //时间控件
            window.onload = function () {
                flatpickr("#start_time", {
                    enableTime: true,
                    altInput: true,
                    altFormat: "Y-m-d H:i:S"
                });

                flatpickr("#end_time", {
                    enableTime: true,
                    altInput: true,
                    altFormat: "Y-m-d H:i:S"
                });
            }
        })
    </script>
@endsection
