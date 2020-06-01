<div class="sidebar__item">
    <h4>Department</h4>
    <ul>
        @foreach(\App\Category::all() as $category)
            <li><a href="{{$category->getCategoryUrl()}}">{{$category->__get("category_name")}}</a></li>
        @endforeach
    </ul>
</div>
