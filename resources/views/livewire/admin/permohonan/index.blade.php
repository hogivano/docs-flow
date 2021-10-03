<section>
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <h5 class="mb-2">Permohonan dan Pesetujuan</h5>
                </div>
                <div>
                    <a href="{{ route('permohonan.create') }}" type="button"
                        class="btn bg-gradient-primary">Permohonan Baru</a>
                </div>
            </div>
            <div class="list-group">
                @foreach ($data as $submission)
                <div wire:key="{{ $submission->id }}" class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-xs text-uppercase">#{{ $submission->code }}</h6>
                        <h6 class="mb-1">{{ $submission->title }}</h6>
                        <p class="text-black-50 text-sm">{{ $submission->description }}</p>
                        @if($submission->application)
                            <p class="text-sm text-bold my-2">Template : {{ $submission->application->title }}</p>
                        @endif
                        <span class="mb-2 text-xs">Create by: <span class="text-dark font-weight-bold ms-sm-2">
                            {{ ($submission->createUser) ? $submission->createUser->name : ''}}</span></span>
                            <span class="mb-2 text-xs">Update by: <span class="text-dark font-weight-bold ms-sm-2">
                                {{ ($submission->updateUser) ? $submission->updateUser->name : ''}}</span></span>
                    </div>
                    <div class="ms-auto text-end">
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('permohonan.detail', ['id' => $submission->id]) }}">
                            <i class="far fa-eye text-dark me-2"></i>Detail
                        </a>
                        @if(request()->get('role') && request()->get('role')->id == 1)
                            <a class="btn btn-link text-info px-3 mb-0" href="{{ route('permohonan.edit', ['id' => $submission->id]) }}"><i
                                    class="fas fa-pencil-alt text-info me-2" aria-hidden="true"></i>Edit</a>
                            @if($submission->application)
                                <button  class="btn btn-link text-danger text-gradient px-3 mb-0" type="button"
                                    wire:click="destroy({{ $submission->id }})"
                                    onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"><i
                                        class="far fa-trash-alt me-2"></i>Delete</button>
                            @endif
                        @endif
                    </div>
                </div>
                @endforeach
                @if(sizeof($data) == 0)
                    <p class="text-black-50 font-weight-light text-sm text-center my-4">Data masih kosong.</p>
                @endif
            </div>
        </div>
    </div>
</section>