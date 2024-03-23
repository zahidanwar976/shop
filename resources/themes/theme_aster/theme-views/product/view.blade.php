@extends('theme-views.layouts.app')

@section('title',translate(str_replace(['-', '_', '/'],' ',$data['data_from'])).' '.translate('products'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="og:title" content="Products of {{$web_config['name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="Products of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
@endpush

@section('content')

    <!-- Main Content -->
    <main class="main-content d-flex flex-column gap-3 pt-3">
        <!-- Product -->
        <section>
            <div class="container">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row gy-2 align-items-center">
                            <div class="col-lg-4">
                                <h3 class="mb-1">{{translate(str_replace(['-', '_', '/'],' ',$data['data_from']))}} {{translate('products')}}</h3>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb fs-12 mb-0">
                                      <li class="breadcrumb-item"><a href="#">{{ translate('home') }}</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">{{translate(str_replace(['-', '_', '/'],' ',$data['data_from']))}} {{translate('products')}} {{ isset($data['brand_name']) ? ' / '.$data['brand_name'] : ''}} {{ request('name') ? '('.request('name').')' : ''}}</li>
                                    </ol>
                                  </nav>
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex justify-content-lg-end flex-wrap gap-2">
                                    <div class="border rounded custom-ps-3 py-2">
                                        <div class="d-flex gap-2">
                                            <div class="flex-middle gap-2">
                                                <i class="bi bi-sort-up-alt"></i>
                                                <span class="d-none d-sm-inline-block">{{translate('Sort_by')}} :</span>
                                            </div>
                                            <div class="dropdown product_view_sort_by">
                                                <button type="button" class="border-0 bg-transparent dropdown-toggle text-dark p-0 custom-pe-3" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{translate('default')}}
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="sort_by_list">
                                                    <li class="sort_by-latest selected" data-value="latest">
                                                        <a class="d-flex" href="javascript:" onclick="filter('latest','{{translate('default')}}')">
                                                            {{translate('default')}}
                                                        </a>
                                                    </li>
                                                    <li class="sort_by-high-low" data-value="high-low">
                                                        <a class="d-flex" href="javascript:" onclick="filter('high-low','{{translate('High_to_Low_Price')}}')">
                                                            {{translate('High_to_Low_Price')}}
                                                        </a>
                                                    </li>
                                                    <li class="sort_by-low-high" data-value="low-high">
                                                        <a class="d-flex" href="javascript:" onclick="filter('low-high','{{translate('Low_to_High_Price')}}')">
                                                            {{translate('Low_to_High_Price')}}
                                                        </a>
                                                    </li>
                                                    <li class="sort_by-a-z" data-value="a-z">
                                                        <a class="d-flex" href="javascript:" onclick="filter('a-z','{{translate('A_to_Z_Order')}}')">
                                                            {{translate('A_to_Z_Order')}}
                                                        </a>
                                                    </li>
                                                    <li class="sort_by-z-a" data-value="z-a">
                                                        <a class="d-flex" href="javascript:" onclick="filter('z-a','{{translate('Z_to_A_Order')}}')">
                                                            {{translate('Z_to_A_Order')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border rounded custom-ps-3 py-2">
                                        <div class="d-flex gap-2">
                                            <div class="flex-middle gap-2">
                                                <i class="bi bi-sort-up-alt"></i>
                                                <span class="d-none d-sm-inline-block">{{translate('Show_Product')}} :</span>
                                            </div>
                                            <div class="dropdown">
                                                <button type="button" class="border-0 bg-transparent dropdown-toggle p-0 custom-pe-3" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{$data['data_from']=="best-selling"||$data['data_from']=="top-rated"||$data['data_from']=="featured_deal"||$data['data_from']=="latest"||$data['data_from']=="most-favorite"?
                                                    str_replace(['-', '_', '/'], ' ', translate($data['data_from'])):translate('Choose Option')}}
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li class="{{$data['data_from']=='latest'? 'selected':''}}">
                                                        <a class="d-flex" href="{{route('products',['id'=> $data['id'],'data_from'=>'latest','page'=>1])}}">
                                                            {{translate('Latest_Products')}}
                                                        </a>
                                                    </li>
                                                    <li class="{{$data['data_from']=='best-selling'? 'selected':''}}">
                                                        <a class="d-flex" href="{{route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])}}">
                                                            {{translate('Best_Selling')}}
                                                        </a>
                                                    </li>
                                                    <li class="{{$data['data_from']=='top-rated'? 'selected':''}}">
                                                        <a class="d-flex" href="{{route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])}}">
                                                            {{translate('Top_Rated')}}
                                                        </a>
                                                    </li>
                                                    <li class="{{$data['data_from']=='most-favorite'? 'selected':''}}">
                                                        <a class="d-flex" href="{{route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])}}">
                                                            {{translate('Most_Favorite')}}
                                                        </a>
                                                    </li>
                                                    @if($web_config['featured_deals'])
                                                    <li class="{{$data['data_from']=='featured_deal'? 'selected':''}}">
                                                        <a class="d-flex" href="{{route('products',['id'=> $data['id'],'data_from'=>'featured_deal','page'=>1])}}">
                                                            {{translate('Featured_Deal')}}
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flexible-grid lg-down-1 gap-3" style="--width: 16rem">
                    <div class="card filter-toggle-aside">
                        <div class="d-flex d-lg-none pb-0 p-3 justify-content-end">
                            <button class="filter-aside-close border-0 bg-transparent">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>

                        <div class="card-body d-flex flex-column gap-4">
                            <!-- Categories -->
                            <div>
                                <h6 class="mb-3">{{translate('Categories')}}</h6>
                                @php($categories=\App\CPU\CategoryManager::parents())
                                <div class="products_aside_categories">
                                    <ul class="common-nav flex-column nav custom-scrollbar flex-nowrap custom_common_nav">
                                        @foreach($categories as $category)
                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category['name']}}</a>
                                                @if ($category->childes->count() > 0)
                                                <span>
                                                    <i class="bi bi-chevron-right"></i>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- Sub Menu -->
                                            @if ($category->childes->count() > 0)
                                            <ul class="sub_menu">
                                                @foreach($category->childes as $child)
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{route('products',['id'=> $child['id'],'data_from'=>'category','page'=>1])}}">{{$child['name']}}</a>
                                                        @if ($child->childes->count() > 0)
                                                        <span>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    @if ($child->childes->count() > 0)
                                                    <ul class="sub_menu">
                                                        @foreach($child->childes as $ch)
                                                        <li>
                                                            <label class="custom-checkbox">
                                                                <a href="{{route('products',['id'=> $ch['id'],'data_from'=>'category','page'=>1])}}">{{$ch['name']}}</a>
                                                            </label>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($categories->count() > 10)
                                <div class="d-flex justify-content-center">
                                    <button class="btn-link text-primary btn_products_aside_categories">{{translate('More_Categories')}}...</button>
                                </div>
                                @endif
                            </div>

                            @if($web_config['brand_setting'])
                            <!-- Brands -->
                            <div>
                                @php($brands = \App\CPU\BrandManager::get_active_brands())
                                <h6 class="mb-3">{{translate('Brands')}}</h6>
                                <div class="products_aside_brands">
                                    <ul class="common-nav nav flex-column pe-2">
                                        @foreach($brands as $brand)
                                        <li>
                                            <div class="flex-between-gap-3 align-items-center">
                                                <label class="custom-checkbox">
                                                    <a href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">{{ $brand['name'] }}</a>
                                                </label>
                                                <span class="badge bg-badge rounded-pill text-dark">{{ $brand['brand_products_count'] }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @if($brands->count() > 10)
                                <div class="d-flex justify-content-center">
                                    <button class="btn-link text-primary btn_products_aside_brands">{{translate('More_Brands')}}...</button>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Ratings -->
                            <div id="ajax-review_partials">
                                @include('theme-views.partials._products_review_partials', ['ratings'=>$ratings])
                            </div>

                            <!-- Price -->
                            <div>
                                <h6 class="mb-3">{{translate('Price')}}</h6>
                                <div class="d-flex align-items-end gap-2">
                                    <div class="form-group">
                                        <label for="min_price" class="mb-1">{{translate('Min')}}</label>
                                        <input type="number" id="min_price" class="form-control form-control--sm" placeholder="$0">
                                    </div>
                                    <div class="mb-2">-</div>
                                    <div class="form-group">
                                        <label for="max_price" class="mb-1">{{translate('Max')}}</label>
                                        <input type="number" id="max_price" class="form-control form-control--sm" placeholder="$1,000">
                                    </div>
                                    <button class="btn btn-primary py-1 px-2 fs-13" onclick="sortByfilterBy()"><i class="bi bi-chevron-right"></i></button>
                                </div>

                                <section class="range-slider">
                                    <span class="full-range"></span>
                                    <span class="incl-range"></span>
                                    <input name="rangeOne" value="0" min="0" max="10000" step="1" type="range" id="price_rangeMin">
                                    <input name="rangeTwo" value="5000" min="0" max="10000" step="1" type="range" id="price_rangeMax">
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="d-flex flex-wrap flex-lg-nowrap align-items-start justify-content-between gap-3 mb-2">
                            <div class="flex-middle gap-3"></div>
                            <div class="d-flex align-items-center mb-3 mb-md-0 flex-wrap flex-md-nowrap gap-3">
                                <ul class="product-view-option option-select-btn gap-3">
                                    <li>
                                        <label>
                                            <input type="radio" name="product_view" value="grid-view" hidden=""
                                            {{(session()->get('product_view_style') == 'grid-view'?'checked':'')}} id="grid-view">
                                            <span class="py-2 d-flex align-items-center gap-2"><i class="bi bi-grid-fill"></i> {{translate('Grid_View')}}</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" name="product_view" value="list-view" hidden=""
                                            {{(session()->get('product_view_style') == 'list-view'?'checked':'')}} id="list-view">
                                            <span class="py-2 d-flex align-items-center gap-2"><i class="bi bi-list-ul"></i> {{translate('List_View')}}</span>
                                        </label>
                                    </li>
                                </ul>
                                <button class="toggle-filter square-btn btn btn-outline-primary rounded d-lg-none">
                                    <i class="bi bi-funnel"></i>
                                </button>
                            </div>
                        </div>

                        @php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))

                        <div id="ajax-products-view">
                            @include('theme-views.product._ajax-products',['products'=>$products,'decimal_point_settings'=>$decimal_point_settings])
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <span id="filter_url" data-url="{{url('/')}}/products"></span>
    <span id="product_view_style_url" data-url="{{route('product_view_style')}}"></span>
    <input type="hidden" value="{{$data['id']}}" id="data_id">
    <input type="hidden" value="{{$data['name']}}" id="data_name">
    <input type="hidden" value="{{$data['data_from']}}" id="data_from">
    <input type="hidden" value="{{$data['min_price']}}" id="data_min_price">
    <input type="hidden" value="{{$data['max_price']}}" id="data_max_price">

    <!-- End Main Content -->
@endsection

