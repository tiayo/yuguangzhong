@inject('category', 'App\Services\Home\CategoryService')
@inject('article', 'App\Services\Home\ArticleService')
@inject('activity', 'App\Services\Home\ActivityService')

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('site.title') }}</title>
    <meta name="keywords" content="余光中,余光中文学馆,文学馆,永春文学馆">
    <meta name="description" content="余光中文学馆官方网站">
    <link rel="stylesheet" href="{{ asset('style/css/css.css') }}" />
    <script type="text/javascript" src="{{ asset('style/js/j.js') }}"></script>
    <script type="text/javascript" src="{{ asset('style/js/all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('style/js/js.js') }}"></script>
</head>

<body>
<div class="all">
    <div class="weather">
        <div class="w1000">
            <div class="l" style="position:relative; top:5px;">
                <iframe width="450" scrolling="no" height="24" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=1&color=%23&icon=1&py=yongchun&wind=1&num=2"></iframe>
            </div>
        </div>
    </div>
    <div class="header">
        <div style="width:1000px; margin:0 auto;">
            {{--<embed src="flash/top.swf" width="1000" height="220"></embed>--}}
        </div>
    </div>
    <div class="navbg">
        <div class="nav cl w1000">
            <ul>
                <li class="nobg">
                    <a href="{{ route('home.index') }}">文学馆首页</a>
                </li>
                @foreach($categories = $category->getParent() as $category)
                    <li>
                        <a href="{{ $category['link'] }}">{{ $category['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

    @section('body')

    @show

<div class="foot">
    <div class="w1000">
        <div class="contact">
            <a href="{{ route('home.index') }}">网站首页</a> |
            @foreach($categories as $category)
                <a href="">{{ $category['name'] }}</a> |
            @endforeach
        </div>
        <div class="information">
            <p>Copyright 2015 ****.gov.cn Inc. All Rights Reserved. 闽ICP备********号</p>
            <p>余光中文学馆 电话：0595-
                <br />
                <span style="font-family: ΢���ź�, Verdana, Arial, sans-serif; font-size: 14px; line-height: 25px; background-color: rgb(240, 240, 240);">{{--预留机构标志--}}</span>
            </p> 技术支持
            <a href="http://www.qsj.cc" target="_blank">泉视界</a>
        </div>
    </div>
</div>
<!--<div class="wxbox">
<div class="close"></div>
</div>-->
</body>

</html>
</body>