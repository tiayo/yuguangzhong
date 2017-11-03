@inject('category_service', 'App\Services\Home\CategoryService')

@php
    $category = $category_service->first(13);
    $childrens = $category_service->getCategoryArray($category_service->getCategoryChildren(13)['childs']);
@endphp

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