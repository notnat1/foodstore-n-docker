<div class="bg-white rounded-bottom-custom shadow-sm p-3 sticky-top mb-4">
    <div class="d-flex justify-content-between">
        <div>
            @php
                $image = auth()->guard('customer')->user()->image 
                    ? asset('/storage/avatars/' . auth()->guard('customer')->user()->image) 
                    : 'https://cdn.jsdelivr.net/gh/SantriKoding-com/assets-food-store/images/user.png';
            @endphp
            <img src="{{ $image }}" class="object-fit-cover rounded-circle" height="45" />
            <span class="fw-bold fs-6 ms-2">{{ auth()->guard('customer')->user()->name }}</span>
        </div>
        <div>
            <!-- component logout livewire -->
            <livewire:auth.logout />
            <!-- end component logout livewire -->
        </div>
    </div>
    <hr />
    <div class="d-flex justify-content-evenly">
        <div>
            <a href="/account/my-orders" wire:navigate class="text-decoration-none">
                <div class="card rounded">
                    <div class="card-body pb-1">
                        <h6 class="small fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                                class="bi bi-bag mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                            My Orders
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="/account/my-profile" wire:navigate class="text-decoration-none">
                <div class="card rounded">
                    <div class="card-body pb-1">
                        <h6 class="small fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                                class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            My Profile
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="/account/password" wire:navigate class="text-decoration-none">
                <div class="card rounded">
                    <div class="card-body pb-1">
                        <h6 class="small fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                                class="bi bi-key" viewBox="0 0 16 16">
                                <path
                                    d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                            Password
                        </h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>