<div class="container">
    <div class="row justify-content-center mt-0" style="margin-bottom: 150px;">
        <div class="col-md-6">

            <x-menus.customer />

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-4">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-key mb-1" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                        </svg>
                        Update Password
                    </h6>
                    <hr />

                    <form wire:submit.prevent="update">

                        <div class="input-group mb-3">
                            <input type="password" wire:model="password" class="form-control rounded @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="New Password">
                        </div>
                        @error('password')
                        <div class="alert alert-danger mt-2 rounded border-0">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="input-group mb-3">
                            <input type="password" wire:model="password_confirmation" class="form-control rounded" placeholder="Confirm Password">
                        </div>

                        <button class="btn btn-orange-2 rounded" type="submit">Update Password</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>