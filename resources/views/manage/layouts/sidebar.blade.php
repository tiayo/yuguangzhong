<!--sidebar nav start-->
<ul style="margin-top:100px;" class="nav nav-pills nav-stacked custom-nav">

    <li class="menu-list" id="nav_0"><a href=""><i class="fa fa-folder-open"></i> <span>文章管理</span></a>
        <ul class="sub-menu-list">
            <li id="nav_0_1"><a href=" {{ route('category_list') }} ">分类管理</a></li>
            <li id="nav_0_2"><a href=" {{ route('article_list') }} ">文章管理</a></li>
        </ul>
    </li>

    <li class="menu-list" id="nav_1"><a href=""><i class="fa fa-shopping-cart"></i> <span>活动管理</span></a>
        <ul class="sub-menu-list">
            <li id="nav_1_1"><a href="{{ route('activity_list') }}">活动管理</a></li>
        </ul>
    </li>

    <li class="menu-list" id="nav_2"><a href=""><i class="fa fa-user"></i> <span>会员管理</span></a>
        <ul class="sub-menu-list">
            <li id="nav_2_1"><a href="{{ route('manager_list') }}">管理员管理</a></li>
        </ul>
    </li>
</ul>
<!--sidebar nav end-->