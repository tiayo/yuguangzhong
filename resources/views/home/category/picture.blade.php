@extends('home.layouts.app')

@section('title', $category['name'])

@section('description', '余光中文学馆官方网站')

@section('body')
    <div class="cl w1000 con_box">
        @include('home.layouts.list_right')
        <div class="q_piclist r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="/">首页</a>
                    <span> > </span>
                    <a href="{{ $category['link'] }}">{{ $category['name']  }}</a>
                </em>
            </div>
            <div class="tpbox">
                <ul class="piclist cl m-20">
                    @foreach($articles as $article)
                    <li>
                        <a href="{{ $article['link'] }}">
                            <img src="{{ $article['picture'] }}"/>
                            <p>{{ $article['title'] }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="search_page">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection