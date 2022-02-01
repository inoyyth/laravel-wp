<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-lg-block" style="z-index: 999;">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @foreach ($view_share['product_categories'] as $item)
                    @php
                        $isHaveChild = SharedHelper::getChild($item->id, 'parent', $view_share['product_categories']);
                    @endphp
                    @if (!empty($isHaveChild))
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">{{ $item->name }} <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach($isHaveChild as $child)
                                    <a href="{{route('category.main', ['slug' => $child->slug])}}" class="dropdown-item">{{ $child->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        @if ($item->parent == 0)
                            <a href="{{route('category.main', ['slug' => $item->slug])}}" class="nav-item nav-link">{{ $item->name }}</a>
                        @endif
                    @endif
                @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        @foreach ($view_share['main_menu'] as $k=>$item)
                            @php
                                $isHaveChild = SharedHelper::getChild($item->ID, 'menu_item_parent', $view_share['main_menu']);
                            @endphp
                            @if (!empty($isHaveChild))
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $item->post_title }}</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        @foreach($isHaveChild as $child)
                                            <a href="{{ $child->url }}" class="dropdown-item">{{ $child->post_title }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                @if ($item->menu_item_parent == 0)
                                    <a href="{{ $item->url }}" class="nav-item nav-link">{{ $item->post_title }}</a>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(empty(session('token')))
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        </div>
                    @else
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ route('customer.main') }}" class="nav-item nav-link">Hi, {{ session('user')->name }}</a>
                            <a href="{{ route('user_logout') }}" class="nav-item nav-link">Logout</a>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>
</div>