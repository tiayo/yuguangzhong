@extends('home.layouts.app')

@section('title', $category['name'])

@section('description', '余光中文学馆官方网站')

@section('body')
    <div class="cl w1000 con_box">
        @include('home.layouts.list_right')
        <div class="q_textlist r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="/">首页</a>
                    <span> > </span>
                    <a href="{{ $category['link'] }}">{{ $category['name']  }}</a>
                </em>
            </div>
            <ul class="cl m-20">
                @foreach($articles as $article)
                    <li>
                        <em>{{ $article['updated_at'] }}</em>
                        <a href="{{ $article['link'] }}" target="_blank">{{ $article['title'] }}</a>
                        <p> {{ $article['abstract'] }}...
                            <a href="{{ $article['link'] }}"
                               target="_blank" class="more">查看全文>></a>
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="search_page">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
