@extends('manage.layouts.app')

@section('title', '添加/管理分类管理')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">文章管理</a></li>
    <li navValue="nav_0_1"><a href="#">添加/管理分类管理</a></li>
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
                添加/管理分类
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">名称</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent_id" class="col-sm-2 col-sm-2 control-label">上级</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="parent_id" name="parent_id">

                                {{--原栏目--}}
                                @if(!empty($old_input['parent_id']))
                                    @foreach($lists as $list)
                                        @if($list['id'] == $old_input['parent_id'])
                                            <option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                                            @php
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                <option value="0">顶级栏目</option>
                                @foreach($lists as $list)
                                    <option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="list_templet" class="col-sm-2 col-sm-2 control-label">列表模板</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="list_templet" placeholder="放空则为默认值"
                                   name="list_templet" value="{{ $old_input['list_templet'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="article_templet" class="col-sm-2 col-sm-2 control-label">文章模板</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="article_templet" placeholder="放空则为默认值"
                                   name="article_templet" value="{{ $old_input['article_templet'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="view" class="col-sm-2 col-sm-2 control-label">是否显示</label>
                        <div class="col-sm-3">
                            <div class="slide-toggle">
                                <div>
                                    <input type="checkbox" class="js-switch" id="view" name="view"
                                           @if($old_input['view'] == 1) checked @endif />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modified_children" class="col-sm-2 col-sm-2 control-label">是否更改下级</label>
                        <div class="col-sm-3">
                            <div class="slide-toggle">
                                <div>
                                    <input type="checkbox" class="js-switch" value="1" id="modified_children" name="modified_children"/>
                                </div>
                            </div>
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
