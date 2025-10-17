<div class="container">
    <div class="row justify-content-center mt-0" style="margin-bottom: 150px;">
        <div class="col-md-6">

            <x-menus.customer />

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-4">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag mb-1" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                        </svg>
                        My Orders
                    </h6>
                    <hr />

                    @forelse ($transactions as $transaction)
                    <div class="card rounded border mb-3">
                        <div class="row g-0">
                            <div class="col-12 col-md-12">
                                <a href="{{ route('account.my-orders.show', $transaction->snap_token) }}" wire:navigate class="text-decoration-none text-dark">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3 mb-1 me-2" viewBox="0 0 16 16">
                                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z" />
                                                </svg>
                                                <span class="fw-bold">Order ID #{{ $transaction->invoice }}</span>
                                            </div>
                                            <div>
                                                @if($transaction->status == 'pending')
                                                <button class="btn btn-warning btn-sm rounded shadow-sm border-0">PENDING</button>
                                                @elseif($transaction->status == 'success')
                                                <button class="btn btn-success btn-sm rounded shadow-sm border-0">SUCCESS</button>
                                                @elseif($transaction->status == 'expired')
                                                <button class="btn btn-warning btn-sm rounded shadow-sm border-0" disabled>EXPIRED</button>
                                                @elseif($transaction->status == 'failed')
                                                <button class="btn btn-danger btn-sm rounded shadow-sm border-0">FAILED</button>
                                                @endif

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <span class="fw-bold">Grand Total:</span>
                                            </div>
                                            <div>
                                                <span class="fw-bold">Rp. {{ number_format($transaction->total) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card rounded border mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="mt-2">
                                    <span class="fw-bold">You don't have any orders.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse

                    <!-- Navigasi Pagination -->
                    {{ $transactions->links('vendor.pagination.simple-default') }}


                </div>
            </div>

        </div>
    </div>
</div>