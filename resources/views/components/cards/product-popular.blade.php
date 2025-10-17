<div class="col-8 col-md-6 mb-4">
    <div class="card border-0 rounded shadow-sm">
        <img src="{{ asset('/storage/' . $product->image) }}" class="rounded-top-custom object-fit-cover" height="200px">
        <div class="card-body">
            <a href="/products/{{ $product->slug }}" class="text-decoration-none text-dark" wire:navigate>
                <h6 class="card-title">{{ $product->title }}</h6>
            </a>
            <p class="fw-bold text-success mt-3">Rp. {{ number_format($product->price) }}</p>
            <div class="d-flex justify-content-between">
                <div class="mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-orange mb-1 me-2" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <span class="fw-bold">{{ number_format($product->ratings_avg_rating, 1) }}</span>
                </div>
                <div>
                    <!-- button add to cart -->
                    <livewire:web.cart.btn-add-to-cart :product_id="$product->id" />
                </div>
            </div>
        </div>
    </div>
</div>