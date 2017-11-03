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