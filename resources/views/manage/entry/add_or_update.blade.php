@extends('manage.layouts.app')

@section('title', '活动报名')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">活动管理</a></li>
    <li navValue="nav_1_1"><a href="#">添加/管理活动报名</a></li>
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
                添加/管理活动报名
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="activity_id" class="col-sm-2 col-sm-2 control-label">活动</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="activity_id" name="activity_id" @if($sign == 'update') disabled @endif>
                                <option value="{{ $activitiy['id'] }}">{{ $activitiy['name'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">姓名</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">电话</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $old_input['phone'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="email" name="email" value="{{ $old_input['email'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark" class="col-sm-2 col-sm-2 control-label">备注</label>
                        <div class="col-sm-3">
                            <textarea class="form-control" id="remark" name="remark">{{ $old_input['remark'] }}</textarea>
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
        })
    </script>
@endsection
