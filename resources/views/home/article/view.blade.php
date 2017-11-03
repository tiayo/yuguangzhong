@extends('home.layouts.app')

@section('title', $article['title'].'-'.$category['name'])

@section('description', $article['abstract'])

@section('body')
    <div class="w1000 cl con_box">
        <div class="conlist l">
            <div class="con_tit">
                <h3>{{ $category['name'] }}</h3>
            </div>
            <ul class="cl">
                @foreach($childrens as $children)
                    <li>
                        <a href="{{ $children['link'] }}">
                            <b></b>{{ $children['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="container r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="{{ route('home.index') }}">首页</a>
                    <span> > </span>
                    <a href="{{ $category['link'] }}">{{ $category['name'] }}</a>
                </em>
            </div>
            <div class="naside_lef">
                <div class="cl">
                    <div class="robing_con cl">
                        <h1>{{ $article['title'] }}</h1>
                        <h5>发布时间：{{ $article['created_at'] }} 作者：{{ $article['writer'] }}
                            <span id="hits"></span>
                            <script language="JavaScript" src="js/api.js"></script>
                        </h5>
                        <div class="textdetail m-20" id="content">
                            {!! $article['content'] !!}
                        </div>
                        <div class="nextlist cl">
                            <p>
                                <b>上一篇：</b>
                                <a href="{{ route('home.article_view', ['type' => 'view', 'article_id' => $pre_article['id']]) }}">{{ $pre_article['title'] }}</a>
                            </p>
                            <p>
                                <b>下一篇：</b>
                                <a href="{{ route('home.article_view', ['type' => 'view', 'article_id' => $next_article['id']]) }}">{{ $next_article['title'] }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection