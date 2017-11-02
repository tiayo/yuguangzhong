@inject('category', 'App\Services\Home\CategoryService')
@inject('article', 'App\Services\Home\ArticleService')
<!DOCTYPE HTML>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('site.title') }}</title>
    <meta name="keywords" content="��������,��춹ŵ�">
    <meta name="description" content="��춹ŵ��ٷ���վ-��������й�����">
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
                <iframe width="450" scrolling="no" height="24" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=1&color=%23&icon=1&py=shangluo&wind=1&num=2"></iframe>
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
                @foreach($category->getParent() as $category)
                <li>
                    <a href="">{{ $category['name'] }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
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
                                        <a href="" target="_blank">
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
                                                    <a href="" target="_blank">{{ $list['title'] }}</a>
                                                </h4>
                                                <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                    <a href="" target="_blank" class="more">[详情]</a>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cl m-5">
                                        <ul class="textlist">
                                            @foreach($article->get(8, 4, 2) as $list)
                                                <li>

                                                    <em>{{ $list->created_at }}</em>
                                                    <a href="" target="_blank">{{ $list->title }}</a>
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
                                                    <a href="" target="_blank">{{ $list['title'] }}</a>
                                                </h4>
                                                <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                    <a href="" target="_blank" class="more">[详情]</a>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cl m-5">
                                        <ul class="textlist">
                                            @foreach($article->get(7, 4, 2) as $list)
                                                <li>

                                                    <em>{{ $list->created_at }}</em>
                                                    <a href="" target="_blank">{{ $list->title }}</a>
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
                                                    <a href="" target="_blank">{{ $list['title'] }}</a>
                                                </h4>
                                                <p> {{ mb_substr($list['abstract'], 0, 40) }}...
                                                    <a href="" target="_blank" class="more">[详情]</a>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="cl m-5">
                                        <ul class="textlist">
                                            @foreach($article->get(6, 4, 2) as $list)
                                                <li>

                                                    <em>{{ $list->created_at }}</em>
                                                    <a href="" target="_blank">{{ $list->title }}</a>
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
                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=81" target="_blank">����</a>
                        <h2>�����ſ�</h2>
                    </div>
                    <div class="con2 cl">
                        <div class="cl core">
                            <div class="l scenic">
                                <div class="x_tit">
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=86">
                                        <h3>�������</h3>
                                    </a>
                                </div>
                                <div class="active">
                                    <dl class="cl">
                                        <dt>
                                            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=191"
                                               title="��춹ŵ����" target="_blank">
                                                <img src="picture/20150501051613728.jpg" alt="��춹ŵ����">
                                            </a>
                                        </dt>
                                        <dd>
                                            <h4>
                                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=191"
                                                   title="��춹ŵ����" target="_blank">��춹ŵ����</a>
                                            </h4>
                                            <p> ��춹ŵ���Ϊ�Ŵ��ľ��¡����Ρ��̼�֮��������ʷ��׷�ݵ�����ս...
                                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=191"
                                                   target="_blank" class="more">[��ϸ]</a>
                                            </p>
                                        </dd>
                                    </dl>

                                </div>
                                <ul class="textlist cl">
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=104"
                                           title="��춹ŵ��Ļ������ſ�����" target="_blank">��춹ŵ��Ļ������ſ�����</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=149"
                                           title="��춹ŵ��Ļ��������ݶ�" target="_blank">��춹ŵ��Ļ��������ݶ�</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=150"
                                           title="��춹ŵ��Ļ����������" target="_blank">��춹ŵ��Ļ����������</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=86&id=151"
                                           title="��춹ŵ��Ļ��������϶�" target="_blank">��춹ŵ��Ļ��������϶�</a>
                                    </li>
                                </ul>
                                <div class="more_but">
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=86" target="_blank">�鿴����</a>
                                </div>
                            </div>
                            <div class="r scenic">
                                <div class="x_tit">
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=87">
                                        <h3>���ľ���</h3>
                                    </a>
                                </div>
                                <div class="active">
                                    <dl class="cl">
                                        <dt>
                                            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=152"
                                               title="馻�����" target="_blank">
                                                <img src="picture/20150504113839346.jpg" alt="馻�����">
                                            </a>
                                        </dt>
                                        <dd>
                                            <h4>
                                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=152"
                                                   title="馻�����" target="_blank">馻�����</a>
                                            </h4>
                                            <p> 馻�����λ�ڵ����س���15���ﴦ������������춹ŵ��ϵ���Ҫ�ӵ�֮һ...
                                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=152"
                                                   target="_blank" class="more">[��ϸ]</a>
                                            </p>
                                        </dd>
                                    </dl>
                                </div>
                                <ul class="textlist cl">
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=805"
                                           title="�ν�߳�" target="_blank">�ν�߳�</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=804"
                                           title="�ν��" target="_blank">�ν��</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=803"
                                           title="��ƽ����ѧ��" target="_blank">��ƽ����ѧ��</a>
                                    </li>
                                    <li>
                                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=87&id=802"
                                           title="������" target="_blank">������</a>
                                    </li>
                                </ul>
                                <div class="more_but">
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=87" target="_blank">�鿴����</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="r w336">
                    <div class="title cl">
                        <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=90" target="_blank">����</a>
                        <h2>��춹ŵ�ר��</h2>
                    </div>
                    <ul class="zine con2 cl">
                        <li>
                            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=90&id=416" title="���뺫�����ò����"
                               target="_blank">
                                <img src="picture/20150625105304179.jpg">
                                <p>���뺫�����ò����</p>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=90&id=373" title="2015�� ��춹ŵ�֮�����Ļ�ר��"
                               target="_blank">
                                <img src="picture/20150504112014487.jpg">
                                <p>2015�� ��춹ŵ�֮�����Ļ�ר��</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="m-12">
                <div class="cl">
                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=46" target="_blank">
                        <div class="l travel_bt">
                            <h1>��������</h1>
                        </div>
                    </a>
                    <div class="r travel_k">
                        <ul class="cl travel">
                            <li>
                                <h5>�����ز�</h5>
                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=103" title="��춹ŵ�馻����ξ����ز�" target="_blank">
                                    <img src="picture/20160815052919482.jpg" alt="��춹ŵ�馻����ξ����ز�">
                                </a>
                                <p> ��춹ŵ�馻��Ļ����ξ�������������й����䣬��ô���Ǿ����˽�...</p>
                            </li>
                            <li>
                                <h5>�Լ�����·��</h5>
                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=104" title="馻��Ļ����ξ���" target="_blank">
                                    <img src="picture/20160815065414380.jpg" alt="馻��Ļ����ξ���">
                                </a>
                                <p>��춹ŵ�馻����ξ����Լ�����·ͼ����춹ŵ���վ�ڵ���·ͼ��������Ʊ...</p>
                            </li>
                            <li>
                                <h5>���κ���</h5>
                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=105" title="��춹ŵ�馻��Ļ����ξ���ס��" target="_blank">
                                    <img src="picture/20160815073919645.jpg" alt="��춹ŵ�馻��Ļ����ξ���ס��">
                                </a>
                                <p>��ʮһ���ջλ�ڵ�����馻������ν���ν�������20�״����෿�ͣ��ṩ...</p>
                            </li>
                            <li>
                                <h5>�����ʳ</h5>
                                <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=106" title="��춹ŵ�馻��Ļ����ξ���  ��ʳ" target="_blank">
                                    <img src="picture/20160816114804377.jpg" alt="��춹ŵ�馻��Ļ����ξ���  ��ʳ">
                                </a>
                                <p>��춹ŵ�馻��Ļ����ξ������׷�����ʳһ���֣������С����ϡ��±���ɫ...</p>
                            </li>

                            <li>
                                <h5>��������</h5>
                                <div style="width:155px; height:200px; overflow:hidden; background:#f8c454; padding-left:20px;">
                                    <iframe width="130" scrolling="no" height="200" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=4&icon=1&py=shangluo&wind=1&num=6"></iframe>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cl pic_box m-12">
                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=84" target="_blank">
                        <div class="l pic_bt">
                            <h1>��ͼ����</h1>
                        </div>
                    </a>
                    <div class="r wfpic">
                        <div class="cl" style="width:914px; overflow:hidden">
                            <ul class="imgbox scrollleft">
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=467" title="��Ϧ�"
                                       target="_blank">
                                        <img src="picture/20160817043624275.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=466" title="����ڻ"
                                       target="_blank">
                                        <img src="picture/20160817042559314.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=465" title="С��Ա�佱ʢ��"
                                       target="_blank">
                                        <img src="picture/20160817042048324.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=464" title="��ˮһ��"
                                       target="_blank">
                                        <img src="picture/20160817041504289.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=463" title="�ν��"
                                       target="_blank">
                                        <img src="picture/20160817041412987.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=462" title="����Ͻ�"
                                       target="_blank">
                                        <img src="picture/20160817041338150.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=461" title="ƽ����ѧ��"
                                       target="_blank">
                                        <img src="picture/20160817041258846.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=460" title="����¥"
                                       target="_blank">
                                        <img src="picture/20160817041219447.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=459" title="��������"
                                       target="_blank">
                                        <img src="picture/20160817041148634.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=458" title="��������"
                                       target="_blank">
                                        <img src="picture/20160817041106354.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=457" title="��������"
                                       target="_blank">
                                        <img src="picture/20160817041036683.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=456" title="������"
                                       target="_blank">
                                        <img src="picture/20160817040935214.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=455" title="馻���վ"
                                       target="_blank">
                                        <img src="picture/20160817040902630.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=454" title="�߳�֮ҹ"
                                       target="_blank">
                                        <img src="picture/20160817040509735.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=353" title="��춹ŵ��޹����ַ"
                                       target="_blank">
                                        <img src="picture/20150501074025195.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=355" title="������Ȼ����"
                                       target="_blank">
                                        <img src="picture/20150501074222328.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=356" title="Ԫ������ַ"
                                       target="_blank">
                                        <img src="picture/20150501074325495.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=358" title="Ϭţɽ"
                                       target="_blank">
                                        <img src="picture/20150501074651666.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=362" title="����ɽ"
                                       target="_blank">
                                        <img src="picture/20150501075119826.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=363" title="����ɽ"
                                       target="_blank">
                                        <img src="picture/20150501075218921.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=366" title="����ɽ"
                                       target="_blank">
                                        <img src="picture/20150501080751405.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=378" title="Ԫ������ַ"
                                       target="_blank">
                                        <img src="picture/20150506025256183.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=379" title="����ɽ"
                                       target="_blank">
                                        <img src="picture/20150506025452722.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=380" title="������������� һ�������ɽ�� ��������"
                                       target="_blank">
                                        <img src="picture/20150506091046217.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=381" title="����ǧ�������� ľ��ɭ�ּ����붭������"
                                       target="_blank">
                                        <img src="picture/20150506091146133.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=383" title="��ˮ���������� �ͷ�ϰϰ����԰  ��������"
                                       target="_blank">
                                        <img src="picture/20150506091348942.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=384" title="�������������� ��ҹ�������ݳ�   ��������"
                                       target="_blank">
                                        <img src="picture/20150506091430936.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=385" title="��ɽ����װ ��Ⱦ�һ��� ��վ���"
                                       target="_blank">
                                        <img src="picture/20150506091512558.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=386" title="�˼��ɾ���˿Ͽ ��ɽ���������� ��������"
                                       target="_blank">
                                        <img src="picture/20150506091554367.jpg">
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=show&catid=84&id=387" title="���ڴ���ɽ���� ��̬���޵�ˮ�� �ŵ¾���"
                                       target="_blank">
                                        <img src="picture/20150506091641447.jpg">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cl m-20">
                <div class="title">
                    <h2>��������</h2>
                </div>
                <div class="links cl con2">
                    <a href="http://www.shaanxi.gov.cn/" target="_blank">����ʡ��������</a> |
                    <a href="http://www.shangluo.gov.cn/" target="_blank">������������Ϣ��</a> |
                    <a href="http://fgw.shangluo.gov.cn/index" target="_blank">�����з���ί</a> |
                    <a href="http://www.sllyj.com/" target="_blank">���������ξ�</a> |
                    <a href="http://www.slwhj.com/" target="_blank">�������Ĺ��¾�</a> |
                    <a href="http://www.shlwl.org.cn/" target="_blank">����������</a> |
                    <a href="http://shangluo.cnwest.com/" target="_blank">����������</a> |
                    <a href="http://www.slrbs.com/    " target="_blank">����֮��</a> |
                    <a href="http://www.shangzhou.gov.cn/index.html" target="_blank">��������������</a> |
                    <a href="http://www.danfeng.gov.cn/" target="_blank">��������������</a> |


                </div>
            </div>
        </div>
    </div>
</div>

<div class="foot">
    <div class="w1000">
        <div class="contact">
            <a href="http://www.swgd.gov.cn/index.php">��վ��ҳ</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=107">���¶�̬</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=81">�����ſ�</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=108">��춹ŵ�ר��</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=109">���η���</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=46">��������</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=91">�Ļ���̳</a> |
            <a href="http://www.swgd.gov.cn/index.php?m=content&c=index&a=lists&catid=114">��վ���</a>
        </div>
        <div class="information">
            <p>Copyright 2015 swgd.gov.cn Inc. All Rights Reserved. ��ICP��15005619��</p>
            <p>�������Ļ����β�ҵ��չ�칫�� ��ַ�����������˽� ��ϵ�绰:0914-2328961
                <br />
                <span style="font-family: ΢���ź�, Verdana, Arial, sans-serif; font-size: 14px; line-height: 25px; background-color: rgb(240, 240, 240);">
                        <script type="text/javascript">document.write(unescape("%3Cspan id='_ideConac' %3E%3C/span%3E%3Cscript src='http://dcs.conac.cn/js/27/387/0000/60892152/CA273870000608921520003.js' type='text/javascript'%3E%3C/script%3E"));</script>
                    </span>
            </p> ����֧�֣�
            <a href="http://www.68time.com" target="_blank">68TIME</a>
        </div>
    </div>
</div>
<!--<div class="wxbox">
<div class="close"></div>
</div>-->
</body>

</html>