@extends('home.layouts.app')

@section('body')
    <div class="cl w1000 con_box">
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
        <div class="q_textlist r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="/">首页</a>
                    <span> > </span>
                    <a href="">{{ $category['name']  }}</a>
                </em>
            </div>
            <ul class="cl m-20">
                @foreach($articles as $article)
                    <li>
                        <em>{{ $article['updated_at'] }}</em>
                        <a href="" target="_blank">{{ $article['title'] }}</a>
                        <p> {{ $article['abstract'] }}...
                            <a href=""
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
