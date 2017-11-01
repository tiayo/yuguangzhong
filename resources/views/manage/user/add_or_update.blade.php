@extends('manage.layouts.app')

@section('title', '会员管理')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_2"><a href="#">会员管理</a></li>
    <li navValue="nav_2_1"><a href="#">会员管理</a></li>
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
                会员资料修改
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" enctype="multipart/form-data" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-sm-2 control-label">登录账号</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="email" placeholder="填写邮箱" name="email" value="{{ $old_input['email'] }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">姓名</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 col-sm-2 control-label">头像</label>
                        <div class="col-sm-3">
                            <input type="file" id="avatar" name="avatar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">默认手机</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="phone" name="phone" value="{{ $old_input['phone'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 col-sm-2 control-label">默认地址</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="address" name="address" value="{{ $old_input['address'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">密码</label>
                        <div class="col-sm-3">
                            {{--避免自动填充--}}
                            <input type="password" id="old_password" name="password" class="hidden" disabled>
                            {{--有输入时才填入name--}}
                            <input type="password" class="form-control" id="password" autoComplete="off" placeholder="放空则使用默认值或不做修改">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 col-sm-2 control-label">状态</label>
                        <div class="col-sm-3">
                            <select class="form-control m-bot15" id="status" name="status" required>
                                @if($old_input['status'] == 0)
                                    <option value="0">禁用</option>
                                @endif
                                <option value="1">正常</option>
                                <option value="0">禁用</option>
                            </select>
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
            })
        })
    </script>
@endsection
