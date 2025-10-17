@section('title')
{{ $product->title }} - Eat Your Favorite Foods
@stop

@section('keywords')
Food Store, Eat Your Favorite Foods
@stop

@section('description')
{{ $product->description }}
@stop

@section('image')
{{ asset('/storage/' . $product->image) }}
@stop

<div class="container" style="margin-bottom: 200px;">
    <div class="row justify-content-center mt-0">
        <div class="col-md-6">

            <div class="bg-white rounded-bottom-custom shadow-sm p-3 mb-5" :style="{ backgroundImage: `url({{ asset('storage/' . $product->image) }})`,height: '300px',backgroundSize: 'cover',backgroundPosition: 'center'}">
                <div class="d-flex justify-content-start">
                    <div>
                        <x-buttons.back />
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded" style="margin-top: -85px;">
                <div class="card-body mt-4">
                    <h5>{{ $product->title }}</h5>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <p class="fw-bold text-success">Rp. {{ number_format($product->price) }}</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-orange mb-1 me-2" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <span class="fw-bold">{{ number_format($product->ratings_avg_rating, 1) }} ({{ $product->ratings_count }} Reviews )</span>
                        </div>
                    </div>

                    <h5 class="mt-3">Description</h5>
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
            </div>

            <h6 class="mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text me-1" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                </svg>
                Rating & Review
            </h6>
            <div class="row mt-3">

                @foreach($product->ratings()->latest()->get() as $rating)
                <div class="col-6 mb-4">
                    <div class="card border-0 shadow-sm rounded h-100">
                        <div class="card-body">
                            <!-- Display Stars -->
                            <div class="d-flex justify-content-center mt-3">
                                @for ($i = 1; $i <= 5; $i++) <label for="star{{ $i }}-{{ $rating->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="cursor-pointer @if($rating->rating >= $i) text-warning @else text-secondary @endif" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    </label>
                                    @endfor
                            </div>

                            <!-- Review text -->
                            <blockquote class="bsb-blockquote-icon mb-3 mt-4">
                                <p>{{ $rating->review }}</p>
                            </blockquote>

                            <!-- Customer Info -->
                            <figure class="d-flex align-items-center m-0 p-0">
                                <img class="img-fluid rounded-circle m-0 border border-3" width="50" loading="lazy" src="{{ asset('/storage/avatars/' . $rating->customer->image) }}" alt="{{ $rating->customer->name }}">
                                <figcaption class="ms-2 mt-1">
                                    <h6 class="mb-1">{{ $rating->customer->name }}</h6>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- button add to cart -->
            <livewire:web.cart.btn-add-to-cart-full :product_id="$product->id" />

        </div>
    </div>
</div>