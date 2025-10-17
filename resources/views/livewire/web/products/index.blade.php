@section('title')
Products - Eat Your Favorite Foods
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


<div class="container" style="margin-bottom: 150px">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="bg-white rounded-bottom-custom shadow-sm p-3 sticky-top mb-4">
                <div class="d-flex justify-content-start">
                    <x-buttons.back />
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <span class="fs-6 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag mb-1" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                        </svg>
                        PRODUCTS
                    </span>
                </div>
            </div>
            <hr />

            <div class="row">
                <div class="col-12 col-md-12 mb-2">
                    @foreach ($products as $product)
                        <x-cards.product :product="$product" />
                    @endforeach
                </div>
            </div>

            <!-- Navigasi Pagination -->
            {{ $products->links('vendor.pagination.simple-default') }}

        </div>
    </div>
</div>