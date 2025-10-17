<div class="col-6 col-md-4 mb-4">
    <a href="/category/{{ $category->slug }}" wire:navigate class="text-decoration-none">
        <div class="card border-0 rounded shadow-sm">
            <div class="card-body text-center">
                <img src="{{ asset('/storage/' . $category->image) }}" class="img-fluid" width="50">
                <label class="text-center">{{ $category->name }}</label>
            </div>
        </div>
    </a>
</div>