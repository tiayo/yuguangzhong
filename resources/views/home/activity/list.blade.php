@extends('home.layouts.app')

@section('title', '活动中心')

@section('description', '余光中文学馆官方网站')

@section('body')
    <div class="cl w1000 con_box">
        @include('home.layouts.activity_right')
        <div class="q_textlist r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="/">首页</a>
                    <span> > </span>
                    <a href="#">文学馆活动</a>
                </em>
            </div>
            <ul class="cl m-20">
                @foreach($activities as $activity)
                    <li>
                        <em>{{ $activity['updated_at'] }}</em>
                        <a href="{{ route('home.activity_view', ['activity_id' => $activity['id']]) }}" target="_blank">
                            {{ $activity['name'] }}
                        </a>
                        <p> 活动类型：{{ config('site.activity_type')[$activity['type']] }}活动<br>
                            活动时间：{{ $activity['start_time'] }}<br>
                            活动主办：{{ $activity['sponsor'] }}<br>
                            活动承办：<span>{{ $activity['contractor'] or $activity['sponsor'] }}<br>
                            状态：<span>{{ config('site.activity_status')[$activity['status']] }}({{ config('site.activity_order')[$activity['order']] }})<br>
                            <a href="{{ route('home.activity_view', ['activity_id' => $activity['id']]) }}" target="_blank" class="more">
                                查看活动介绍及报名 >>
                            </a>
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="search_page">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@endsection
