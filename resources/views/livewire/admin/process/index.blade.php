<div class="card">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between">
            <div class="title">
                <h5 class="mb-2">Process</h5>
            </div>
            <div>
                <a href="{{ route('process.create') }}" type="button"
                    class="btn bg-gradient-primary">Baru</a>
            </div>
        </div>
        <div class="list-group">
            @foreach ($data as $process)
            <div wire:key="{{ $process->id }}" class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-sm">{{ $process->title }}</h6>
                    <p class="text-black-50 text-sm">{{ $process->description }}</p>
                    @if($process->application)
                    <p class="text-sm text-bold my-2">Application : {{ $process->application->title }}</p>
                    @endif
                    <span class="mb-2 text-xs">Message Pending: <span class="text-dark font-weight-bold ms-sm-2">
                        {{ $process->message_pending }}</span></span>
                    <span class="mb-2 text-xs text-danger">Message Failure: <span
                            class="text-dark ms-sm-2 font-weight-bold">{{ $process->message_failure }}</span></span>
                    <span class="text-xs text-success">Message Success: <span
                            class="text-dark ms-sm-2 font-weight-bold">{{ $process->message_success }}</span></span>
                </div>
                <div class="ms-auto text-end">
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('process.edit', ['id' => $process->id]) }}"><i
                            class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    @if($process->application)
                        <button  class="btn btn-link text-danger text-gradient px-3 mb-0" type="button"
                            wire:click="destroy({{ $process->id }})"
                            onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"><i
                                class="far fa-trash-alt me-2"></i>Delete</button>
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
