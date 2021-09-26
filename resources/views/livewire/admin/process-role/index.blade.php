<section>
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex h-100 justify-content-between">
                <div class="d-flex flex-column">
                    <p class="mb-1 pt-2 text-bold">Untuk memberikan hak akses kepada semua role yang ada</p>
                    <h5 class="font-weight-bolder">Process Role</h5>
                </div>
            </div>
            <div class="list-group">
                @foreach ($applications as $app)
                <div wire:key="{{ $app->id }}"
                    class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg align-items-center">
                    <h6 class="mb-0 text-sm">{{ $app->title }}</h6>
                    <div class="ms-auto text-end">
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('process-role.setting-byappid', ['application_id' => $app->id]) }}"><i
                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Setting</a>
                    </div>
                </div>
                @endforeach
                @if(sizeof($applications) == 0)
                    <p class="text-black-50 font-weight-light text-sm text-center my-4">Data masih kosong.</p>
                @endif
            </div>
        </div>
    </div>
</section>