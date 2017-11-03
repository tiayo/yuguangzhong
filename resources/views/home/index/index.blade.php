@inject('category', 'App\Services\Home\CategoryService')
@inject('article', 'App\Services\Home\ArticleService')
@inject('activity', 'App\Services\Home\ActivityService')

@extends('home.layouts.app')

@section('title', "首页")

@section('description', '余光中文学馆官方网站')

@section('body')
        <style>
            .index_tab li {
                width: 25%;
            }
        </style>
        <div class="wrap">
            <div class="w1000">
                <div class="aside_lef cl p_10">
                    <div class="l w638">
                        <div class="flashbox">
                            <div class="focusbox">
                                <div class="focus_panel">
                                    <div>
                                        @foreach($article->get(0, 5, 0, 4, 1) as $list)
                                            <a href="{{ $list['link'] }}" target="_blank">
                                                <img src="{{ $list['picture'] }}">
                                                <span>{{ $list['title'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="focus_trigger"></div>
                                <script>huandeng();</script>
                            </div>
                        </div>
                    </div>
                    <div class="r w350">
                        <div class="cl tab_two">
                            <ul class="index_tab cl">
                                <li class="current">
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=116">文学馆新闻</a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=64">文学动态</a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=80">媒体报道</a>
                                </li>
                            </ul>
                            <div class="index_content con1">
                                <div class="f_con">
                                    <div class="hotnews">
                                        <ul class="news_top cl">
                                            @foreach($article->get(8, 2, 0) as $list)
                                                <li>
                                                    <h4>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                                    </h4>
                                                    <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                        <a href="{{ $list['link'] }}" target="_blank" class="more">[详情]</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="cl m-5">
                                            <ul class="textlist">
                                                @foreach($article->get(8, 4, 2) as $list)
                                                    <li>

                                                        <em>{{ $list->created_at }}</em>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="f_con" style="display:none">
                                    <div class="hotnews">
                                        <ul class="news_top cl">
                                            @foreach($article->get(7, 2, 0) as $list)
                                                <li>
                                                    <h4>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                                    </h4>
                                                    <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                        <a href="{{ $list['link'] }}" target="_blank" class="more">[详情]</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="cl m-5">
                                            <ul class="textlist">
                                                @foreach($article->get(7, 4, 2) as $list)
                                                    <li>

                                                        <em>{{ $list->created_at }}</em>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="f_con" style="display:none">
                                    <div class="hotnews">
                                        <ul class="news_top cl">
                                            @foreach($article->get(6, 2, 0) as $list)
                                                <li>
                                                    <h4>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                                    </h4>
                                                    <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                        <a href="{{ $list['link'] }}" target="_blank" class="more">[详情]</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="cl m-5">
                                            <ul class="textlist">
                                                @foreach($article->get(6, 4, 2) as $list)
                                                    <li>

                                                        <em>{{ $list->created_at }}</em>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cl" style=" margin-top:10px;">
                    <div class="l general">
                        <div class="title cl">
                            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=81" target="_blank">更多</a>
                            <h2>文化产业</h2>
                        </div>
                        <div class="con2 cl">
                            <div class="cl core">
                                <div class="l scenic">
                                    <div class="x_tit">
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=86">
                                            <h3>收藏资料</h3>
                                        </a>
                                    </div>
                                    <div class="active">
                                        @foreach($article->get(18, 1, 0) as $list)
                                        <dl class="cl">
                                            <dt>
                                                <a href="{{ $list['link'] }}" target="_blank">
                                                    <img src="{{ $list['picture'] }}">
                                                </a>
                                            </dt>
                                            <dd>
                                                <h4>
                                                    <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                                </h4>
                                                <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                    <a href="{{ $list['link'] }}"
                                                       target="_blank" class="more">[详情]</a>
                                                </p>
                                            </dd>
                                        </dl>
                                        @endforeach
                                    </div>
                                    <ul class="textlist cl">
                                        @foreach($article->get(18, 4, 1) as $list)
                                        <li>
                                            <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="more_but">
                                        <a href="{{ $list['link'] }}" target="_blank">更多</a>
                                    </div>
                                </div>
                                <div class="r scenic">
                                    <div class="x_tit">
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=87">
                                            <h3>余光中之友</h3>
                                        </a>
                                    </div>
                                    <div class="active">
                                        @foreach($article->get(20   , 1, 0) as $list)
                                            <dl class="cl">
                                                <dt>
                                                    <a href="{{ $list['link'] }}" target="_blank">
                                                        <img src="{{ $list['picture'] }}">
                                                    </a>
                                                </dt>
                                                <dd>
                                                    <h4>
                                                        <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                                    </h4>
                                                    <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                        <a href="{{ $list['link'] }}"
                                                           target="_blank" class="more">[详情]</a>
                                                    </p>
                                                </dd>
                                            </dl>
                                        @endforeach
                                    </div>
                                    <ul class="textlist cl">
                                        @foreach($article->get(20, 4, 1) as $list)
                                            <li>
                                                <a href="{{ $list['link'] }}" target="_blank">{{ $list['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="more_but">
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=87" target="_blank">更多</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="r w336">
                        <div class="title cl">
                            <a href="{{ $list['link'] }}" target="_blank">更多</a>
                            <h2>文学作品展示</h2>
                        </div>
                        <ul class="zine con2 cl">
                            @foreach($article->get(10, 2) as $list)
                                <li>
                                    <a href="{{ $list['link'] }}" target="_blank">
                                        <img src="{{ $list['picture'] }}">
                                        <p>{{ $list['title'] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="m-12">
                    <div class="cl">
                        <div class="l travel_bt">
                            <h1>文学馆活动</h1>
                        </div>
                        <div class="r travel_k">
                            <ul class="cl travel">
                                @foreach($activity->get(4) as $list)
                                    <li>
                                        <h5>{{ $list['name'] }}</h5>
                                        <a href="{{ Route('home.activity_view', ['activity_id' => $list['id']]) }}" target="_blank">
                                            <img src="{{ $list['picture'] }}">
                                        </a>
                                        <p>{{ mb_substr(strip_tags($list['content']), 0, 40) }}...</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="cl pic_box m-12">
                        <div class="l pic_bt">
                            <h1>视频资料</h1>
                        </div>
                        <div class="r wfpic">
                            <div class="cl" style="width:914px; overflow:hidden">
                                <ul class="imgbox scrollleft">
                                    @foreach($article->get(10, 10) as $list)
                                        <li>
                                            <a href="{{ $list['link'] }}" target="_blank">
                                                <img src="{{ $list['picture'] }}">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cl m-20">
                    <div class="title">
                        <h2>友情链接</h2>
                    </div>
                    <div class="links cl con2">
                        <a href="http://zgyc.com.cn/" target="_blank">永春网</a> |
                    </div>
                </div>
            </div>
        </div>
@endsection