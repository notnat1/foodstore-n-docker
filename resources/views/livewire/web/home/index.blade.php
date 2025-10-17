@section('title')
Food Store - Eat Your Favorite Foods
@stop

@section('keywords')
Food Store, Eat Your Favorite Foods
@stop

@section('description')
Food Store - Eat Your Favorite Foods
@stop

@section('image')
{{ asset('images/logo.png') }}
@stop

<div>
    <div class="container" style="margin-bottom: 120px">

        <!-- Search Bar -->
        <x-utils.search-bar />

        <!-- Sliders -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div id="carouselExample" class="carousel slide w-100">
                    <div class="carousel-inner">

                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-item @if($key == 0) active @endif">
                                <img src="{{ asset('/storage/' . $slider->image) }}" class="d-block w-100 rounded">
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-md-6">
                <span class="fs-6 fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box mb-1" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                    </svg>
                    CATEGORIES
                </span>
                <hr />
                <div class="row flex-nowrap overflow-auto scroll-custom">
                    @foreach ($categories as $category)
                        <x-cards.category :category="$category" />
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Popular -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="fs-6 fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag mb-1" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                            PRODUCTS <span class="text-orange">POPULER</span>
                        </span>
                    </div>
                    <div>
                        <a href="/products" wire:navigate class="text-decoration-none text-orange fw-bold">
                            Lihat Lainnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </a>
                    </div>
                </div>

                <hr />
                <div class="row flex-nowrap overflow-auto scroll-custom">

                    @foreach ($popularProducts as $product)
                        <x-cards.product-popular :product="$product" />
                    @endforeach

                </div>
            </div>
        </div>

        <!-- Products Latest -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="fs-6 fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag mb-1" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                            PRODUCTS <span class="text-orange">TERBARU</span>
                        </span>
                    </div>
                    <div>
                        <a href="/products" wire:navigate class="text-decoration-none text-orange fw-bold">
                            Lihat Lainnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </a>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-12 col-md-12 mb-2">
                        @foreach ($latestProducts as $product)
                            <x-cards.product :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>