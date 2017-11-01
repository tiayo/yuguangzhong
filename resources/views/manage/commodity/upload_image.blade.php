@extends('manage.layouts.app')

@section('title', '商品图片管理')

@section('style')
    @parent
    {{--编辑器--}}
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

    <style>
        .image_border{
            width: 30%;
            float: left;
            border: 1px solid #ccc;
            border-bottom: 1px solid #ccc !important;
            margin-left: 2% !important;
            padding: 1em 0 0 0;
        }
    </style>
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">商品管理</a></li>
    <li navValue="nav_1_2"><a href="#">商品图片管理</a></li>
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
                {{ $commodity['name'] }}
            </header>
            <div class="panel-body">
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

                <form id="form" class="form-horizontal adminex-form" enctype="multipart/form-data" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    @for($i=0; $i<9; $i++)
                        <div class="form-group image_border">
                            <label for="image_{{ $i }}" class="col-sm-2 col-sm-2 control-label">图片{{ $i + 1 }}</label>
                            <div class="col-sm-3">
                                <div style="width: 100%; height: 150px; margin-bottom: 0.5em">
                                    @if(empty($commodity['image_'.$i]))
                                        <img src="{{ asset('/style/media/image/no_photo.jpg') }}" height="100%">
                                        @else
                                        <img src="{{ $commodity['image_'.$i] }}" height="100%">
                                    @endif
                                </div>
                                <input type="file" name="image_{{ $i }}" id="image_{{ $i }}">
                            </div>
                        </div>
                    @endfor

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

            //开启编辑器
            UE.getEditor('editor')
        })
    </script>
@endsection
