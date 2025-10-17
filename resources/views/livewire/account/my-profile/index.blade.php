<div class="container">
    <div class="row justify-content-center mt-0" style="margin-bottom: 150px;">
        <div class="col-md-6">

            <x-menus.customer />

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-4">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person mb-1" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                        My Profile
                    </h6>
                    <hr />

                    <form wire:submit.prevent="update">

                        <div class="input-group mb-3">
                          <input type="file" wire:model="image" class="form-control rounded @error('image') is-invalid @enderror" v-model="image" placeholder="Upload Image" onchange="previewImage')">
                        </div>
                        @error('image')
                            <div class="alert alert-danger mt-2 rounded border-0">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="input-group mb-3">
                          <input type="text" wire:model="name" class="form-control rounded @error('name') is-invalid @enderror" v-model="name" placeholder="Full Name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger mt-2 rounded border-0">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <div class="input-group mb-3">
                          <input type="email" wire:model="email" class="form-control rounded @error('email') is-invalid @enderror" v-model="email" placeholder="Email Address">
                        </div>
                        @error('email')
                            <div class="alert alert-danger mt-2 rounded border-0">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <button class="btn btn-orange-2 rounded" type="submit">Update Profile</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>