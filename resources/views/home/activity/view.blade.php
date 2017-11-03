@extends('home.layouts.app')

@section('title', "活动信息")

@section('description', '')

@section('body')
    <div class="w1000 cl con_box">
        @include('home.layouts.activity_right')
        <div class="container r">
            <div class="con_title cl">
                <em>当前位置
                    <a href="/">首页</a>
                    <span> > </span>
                    <a href="#">{{ $activity['name'] }}</a></em>
            </div>
            <div class="naside_lef">
                <div class="cl">
                    <div class="robing_con cl">
                        <h1>{{ $activity['name'] }}</h1>
                        <h5>发布时间：{{ $activity['created_at'] }}</h5>
                        <div class="ac_picture">
                            <img src="{{ $activity['picture'] }}">
                        </div>
                        <div class="ac-info">
                            <div class="acName">活动类型：<span>{{ config('site.activity_type')[$activity['type']] }}活动</span></div>
                            <div class="acTime">活动时间：<span>{{ $activity['start_time'] }}</span></div>
                            <div class="host">活动主办：<span>{{ $activity['sponsor'] }}</span></div>
                            <div class="undertake">活动承办：<span>{{ $activity['contractor'] or $activity['sponsor'] }}</span></div>
                        </div>
                        <div class="ac-content">
                            <div class="acc-title">活动内容</div>
                            <div class="acc-con">
                                {!! $activity['content'] !!}
                            </div>
                        </div>
                        @if($activity['order'] == 0)
                            <span class="parting_line"></span>
                            <form method="post" action="{{ route('home.entry_add', ['activity_id' => $activity_id]) }}" class="ac-form">
                                {{ csrf_field() }}
                                <div class="form-title">报名参加活动</div>
                                <div class="form-input">
                                    <div class="ac-idcard">
                                        <label for="">姓名*：</label>
                                        <input type="text" name="name" placeholder="请在此处填写您的姓名" required>
                                    </div>
                                    <div class="ac-idcard">
                                        <label for="">电话*：</label>
                                        <input type="text" name="phone" placeholder="请在此处填写您的电话号码" required>
                                    </div>
                                    <div class="ac-idcard">
                                        <label for="">邮箱：</label>
                                        <input type="text" name="email" placeholder="请在此处填写您的邮箱">
                                    </div>
                                    <div class="ac-idcard">
                                        <label for="">备注：</label>
                                        <input type="text" name="remark" placeholder="请在此处填写您需要告知主办方的信息">
                                    </div>
                                    <div class="ac-idcard">
                                        <label for="">验证码：</label>
                                        <input type="text" name="captcha" placeholder="输入下方验证码" style="width: 27%" required>
                                        <img src="{{ route('captcha', ['group' => 'entry']) }}">
                                    </div>
                                </div>
                                <button class="ac-button" type="submit">提交报名申请</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @foreach($errors->all() as $error)
            alert("{{ $error }}");
        @endforeach
    </script>
@endsection
