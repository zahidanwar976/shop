<section>
    <div class="container">
        <div class="card">
            <div class="p-3 p-sm-4">
                <div class="d-flex flex-wrap justify-content-between gap-3 mb-3 mb-sm-4">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <h2><span class="text-primary">{{ translate('top') }}</span> {{ translate('stores') }}</h2>
                    </div>
                    <div class="swiper-nav d-flex gap-2 align-items-center">
                        <a href="{{route('sellers')}}" class="btn-link text-primary">{{ translate('View_All') }}</a>
                        <div class="swiper-button-prev top-stores-nav-prev position-static rounded-10"></div>
                        <div class="swiper-button-next top-stores-nav-next position-static rounded-10"></div>
                    </div>
                </div>
                <div class="swiper-container">
                    <!-- Swiper -->
                    <div class="position-relative">
                        <div class="swiper" data-swiper-loop="true" data-swiper-margin="20"
                             data-swiper-pagination-el="null" data-swiper-navigation-next=".top-stores-nav-next"
                             data-swiper-navigation-prev=".top-stores-nav-prev"
                             data-swiper-breakpoints='{"0": {"slidesPerView": "1"}, "768": {"slidesPerView": "2"}, "992": {"slidesPerView": "3"}}'>
                            <div class="swiper-wrapper">
                                @foreach($top_sellers as $seller)
                                    @if($seller->shop)
                                        <div class="swiper-slide align-items-start bg-light rounded">
                                            <!-- Top Store -->
                                            <div class="bg-light position-relative rounded p-3 p-sm-4 w-100">
                                                @if(count($seller->coupon)>0)
                                                <div class="offer-text">
                                                    {{ translate('USE_COUPON') }} : {{ $seller->coupon[0]['code'] }}
                                                </div>
                                                @endif

                                                <div class="{{ count($seller->coupon)>0 ? 'mt-4' :'' }} mb-3">
                                                    <h5 class="mb-1"><a href="javascript:" onclick="location.href='{{route('shopView',['id'=>$seller['id']])}}'">{{ $seller->shop->name }}</a></h5>
                                                    <div class="text-muted">{{ $seller->product_count }} {{ translate('products') }}</div>
                                                    <div class="d-flex gap-2 align-items-center mt-1">
                                                        <div class="star-rating text-gold fs-12">
                                                            @for($inc=0;$inc<5;$inc++)
                                                                @if($inc<$seller->average_rating)
                                                                    <i class="bi bi-star-fill"></i>
                                                                @else
                                                                    <i class="bi bi-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span>({{ $seller->rating_count }})</span>
                                                    </div>
                                                </div>
                                                @if($seller->product)
                                                    <div class="auto-col gap-3" style="--minWidth: 3.75rem; --maxWidth: {{ count($seller->product)==1 ? '6.5rem' : '1fr' }}">
                                                        @foreach($seller->product as $product)
                                                            <a href="{{route('product',$product['slug'])}}"
                                                               class="store-product d-flex flex-column gap-2 align-items-center">
                                                                <div class="store-product__top border rounded">
                                                                    <span class="store-product__action preventDefault">
                                                                        <i class="bi bi-eye fs-12" onclick="quickView('{{$product['id']}}', '{{route('quick-view')}}')"></i>
                                                                    </span>

                                                                    <img width="100" src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                                                         onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'"
                                                                         alt="" loading="lazy" class="dark-support rounded ">
                                                                </div>
                                                                <div class="product__price d-flex justify-content-center flex-wrap column-gap-2">
                                                                    @if($product['discount'] > 0)
                                                                        <del class="product__old-price">{{\App\CPU\Helpers::currency_converter($product['unit_price'])}}</del>
                                                                    @endif
                                                                    <ins class="product__new-price">
                                                                        {{\App\CPU\Helpers::currency_converter($product['unit_price']-\App\CPU\Helpers::get_product_discount($product,$product['unit_price']))}}
                                                                    </ins>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- for mobile start -->
        @if(isset($footer_banner[1]))
            <div class="col-12 mt-3 d-sm-none">
                <a href="{{ $footer_banner[1]['url'] }}" class="ad-hover">
                    <img src="{{asset('storage/app/public/banner')}}/{{$footer_banner[1]['photo']}}" loading="lazy" alt=""
                            onerror="this.src='{{theme_asset('assets/img/image-place-holder-2:1.png')}}'"
                            class="dark-support rounded w-100">
                </a>
            </div>
        @endif
        <!-- for mobile end -->
    </div>
</section>
