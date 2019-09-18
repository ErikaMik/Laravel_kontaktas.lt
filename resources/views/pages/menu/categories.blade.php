<ul class="navbar-nav mr-auto">
    @foreach($categories as $category)
        @if(count($category->subCategories) === 0)
            <li class="nav-item">
                <a class="nav-link" href="#" role="button">{{$category->title}}</a>
            </li>
        @else

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$category->title}}</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach($category->subCategories as $subCategory)
                        <a class="dropdown-item" href={{route('categories.show', $subCategory->slug)}}>{{$subCategory->title}}</a>
                    @endforeach
                </div>
                @endif
            </li>
    @endforeach
</ul>
