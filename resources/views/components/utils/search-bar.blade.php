<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-10 col-md-10">
                <div class="text-center">
                    <form action="/products" method="GET">
                        <div class="input-group mb-3 rounded">
                            <input type="text" name="search" class="form-control form-control-lg rounded shadow-sm border-0" placeholder="cari yang kamu inginkan..." aria-label="Example text with button addon" aria-describedby="button-addon1" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-2 col-md-2">
                <div class="text-end">
                    <a href="/login" wire:navigate>
                        @php
                            $image = auth()->guard('customer')->check() && auth()->guard('customer')->user()->image 
                                ? asset('/storage/avatars/' . auth()->guard('customer')->user()->image) 
                                : 'https://cdn.jsdelivr.net/gh/SantriKoding-com/assets-food-store/images/user.png';
                        @endphp
                        <img src="{{ $image }}" class="object-fit-cover rounded-circle" height="45" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>