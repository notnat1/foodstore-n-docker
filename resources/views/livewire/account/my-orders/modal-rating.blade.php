<div class="modal fade" wire:ignore.self ref="modal" id="modal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded border-0 shadow-sm">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Rating</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="d-flex gap-2 rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <label for="star{{ $i }}" class="mb-0 position-relative">
                                
                                <input wire:click="setRating({{ $i }})" type="radio" id="star{{ $i }}" value="{{ $i }}" 
                                    class="position-absolute start-0 top-0 w-100 h-100 opacity-0"  style="cursor: pointer"/>

                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" style="cursor: pointer"
                                    class="cursor-pointer @if($rating >= $i) text-orange @else text-secondary @endif" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>

                            </label>
                        @endfor
                    </div>
                </div>
                @error('rating')
                    <div class="alert alert-danger mt-2 rounded border-0">
                        {{ $message }}
                    </div>
                @enderror

                <div class="d-flex justify-content-center mt-3">
                    <textarea class="form-control @error('review') is-invalid @enderror" placeholder="Tulis ulasan disini..." rows="3" wire:model="review"></textarea>
                </div>
                @error('review')
                    <div class="alert alert-danger mt-2 rounded border-0">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded border-0 shadow-sm"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="storeRating" class="btn btn-primary rounded border-0 shadow-sm" data-bs-dismiss="modal">Send</button>
            </div>
        </div>
    </div>
</div>