@section('title')
Checkout - Eat Your Favorite Foods
@stop

@section('keywords')
Food Store, Eat Your Favorite Foods
@stop

@section('description')
Checkout - Food Store - Eat Your Favorite Foods
@stop

@section('image')
{{ asset('images/logo.png') }}
@stop

<div>
    <div class="container">

        <div class="row justify-content-center mt-0" style="margin-bottom: 320px;">
            <div class="col-md-6">

                <div class="bg-white rounded-bottom-custom shadow-sm p-3 sticky-top mb-3">
                    <div class="d-flex justify-content-start">
                        <div>
                            <x-buttons.back />
                        </div>
                    </div>
                </div>

                <div class="card rounded shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt mb-1" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            Shipping Information
                        </h6>
                        <hr />

                        <select class="form-select rounded mb-3" wire:model.live="province_id">
                            <option value="">-- Select Province --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>

                        <select class="form-select rounded mb-3" wire:model.live="city_id" wire:key="{{ $province_id }}">
                            <option value="">-- Select City --</option>
                            @foreach (\App\Models\City::where('province_id', $province_id)->get() as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <div class="mb-3">
                            <textarea class="form-control rounded" wire:model.live="address" rows="3" placeholder="Address:  Jl. Kebon Jeruk No. 1, Jakarta Barat"></textarea>
                        </div>

                    </div>
                </div>

                @if($city_id)
                <div class="card rounded shadow-sm border-0 mb-5">
                    <div class="card-body">

                        <h6>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-truck mb-1" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                            </svg>
                            Courier Delivery
                        </h6>
                        <hr />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="courier" id="inlineRadio1" wire:click="changeCourier('jne')">
                            <label class="form-check-label" for="inlineRadio1">JNE</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="courier" id="inlineRadio2" wire:click="changeCourier('pos')">
                            <label class="form-check-label" for="inlineRadio2">POS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="courier" id="inlineRadio3" wire:click="changeCourier('tiki')">
                            <label class="form-check-label" for="inlineRadio3">TIKI</label>
                        </div>

                        <div class="justify-content-center mt-3 mb-3 text-center">
                            <div wire:loading wire:target="changeCourier">
                                <div class="spinner-border text-orange" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h6 class="mt-2 text-orange">Loading...</h6>
                            </div>
                        </div>

                        {{-- Cost options --}}

                        @if($showCost)
                        <hr>
                        @endif

                        @if($showCost)
                        <div class="mb-3">
                            @foreach($costs ?? [] as $cost)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label font-weight-normal me-2">
                                    <input class="form-check-input" type="radio" name="cost" wire:click="getServiceAndCost('{{ $cost['cost'][0]['value'] }}|{{ $cost['service'] }}')" />
                                    <span class="ms-1">{{ $cost['service'] }} - Rp {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                </div>
                @endif

            </div>

        </div>
    </div>

    <div class="container fixed-total">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card rounded shadow-sm border-0 mb-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0">Total</h6>
                            </div>
                            <div class="ms-auto">
                                <h6 class="mb-0">Rp. {{ number_format($totalPrice) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h6 class="mb-0">Ongkos Kirim</h6>
                            </div>
                            <div class="ms-auto">
                                <h6 class="mb-0">Rp. {{ number_format($selectCost) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h5 class="fw-bold mb-0">Grand Total</h5>
                            </div>
                            <div class="ms-auto">
                                <h5 class="fw-bold mb-0">Rp. {{ number_format($grandTotal) }}</h5>
                            </div>
                        </div>
                        @if($selectCost > 0)

                            <hr style="border: dotted 1px #e92715;">

                            <livewire:web.checkout.btn-checkout 
                                key="{{ now() }}" 
                                :province_id="$province_id" 
                                :city_id="$city_id" 
                                :address="$address" 
                                :grandTotal="$grandTotal" 
                                :totalWeight="$totalWeight" 
                                :selectCourier="$selectCourier" 
                                :selectService="$selectService" 
                                :selectCost="$selectCost" 
                            />

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>