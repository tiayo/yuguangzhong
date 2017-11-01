@extends('manage.layouts.app')

@section('title', '修改订单')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_3"><a href="#">订单管理</a></li>
    <li navValue="nav_3_1"><a href="#">修改订单</a></li>
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
                修改订单
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="commodity" class="col-sm-2 col-sm-2 control-label">商品</label>
                        <div class="col-sm-3">
                            @if(is_array($old_input['commodity']))
                                {{ $old_input['commodity'] = implode($old_input['commodity'], ',') }}
                            @endif

                            @foreach(explode(',', $old_input['commodity']) as $commodity)
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="commodity[]" value="{{ $commodity}}" checked>
                                    {{ \App\Commodity::find($commodity)->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">收件人</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="address" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 col-sm-2 control-label">地址</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="address" name="address" value="{{ $old_input['address'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 col-sm-2 control-label">电话</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $old_input['phone'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 col-sm-2 control-label">价格</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="price" name="price" value="{{ $old_input['price'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 col-sm-2 control-label">寄送方式</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="type" name="type">
                                @foreach(config('site.order_type') as $key => $list)
                                    <option value="{{ $key }}">{{ $list }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tracking" class="col-sm-2 col-sm-2 control-label">运送编号</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="tracking" name="tracking" value="{{ $old_input['tracking'] }}">
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
@endsection
