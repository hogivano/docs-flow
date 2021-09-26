<section>
    @if($process && $application)
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <h5 class="mb-0 text-black-50">Process</h5>
                    <h5 class="mb-1 pt-2 text-bold mb-3">{{ $process->title }}</h5>
                </div>
                <div>
                    <a class="bg-info px-2 py-1 mx-1 rounded-2 cursor-pointer" 
                        href="{{ route('process.edit', ['id' => $process->id]) }}">
                        <i class="fas fa-pen text-white"></i>
                    </a>
                </div>
            </div>
            <div class="text-black-50 text-sm mb-2">
                Application : {{ $application->title }}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="title">
                    <h5 class="mb-2">Process Action</h5>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('process-action.create', ['process_id' => $process->id]) }}"
                        class="btn bg-gradient-primary">Baru</a>
                </div>
            </div>
            <div class="list-group">
                @foreach ($processAction as $pro)
                <div wire:key="{{ $pro->id }}" class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">{{ $pro->label_input }}</h6>
                        <p class="text-black-50 text-sm">{{ $pro->description }}</p>
                        <span class="mb-4 text-xs text-dark">Label Input: <span class="text-dark font-weight-bold ms-sm-2">
                            {{ ($pro->label_input) ? $pro->label_input : 'null' }}</span></span>
                        <span class="mb-2 text-xs">Message Pending: <span class="text-dark font-weight-bold ms-sm-2">
                            {{ ($pro->message_pending) ? $pro->message_pending : 'null' }}</span></span>
                        <span class="mb-2 text-xs text-danger">Message Failure: <span
                                class="text-dark ms-sm-2 font-weight-bold">{{ ($pro->message_failure) ? $pro->message_failure : 'null' }}</span></span>
                        <span class="text-xs text-success">Message Success: <span
                                class="text-dark ms-sm-2 font-weight-bold">{{ ($pro->message_success) ? $pro->message_success : 'null' }}</span></span>
                        <div>
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                    @if($pro->is_required == 1) checked @endif disabled>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Mandatory (aksi harus dilakukan)</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                    @if($pro->process_show == 1) checked @endif disabled>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Tampil Aksi (akan tampil di pelanggan)</label>
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto text-end">
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('process-action.edit-byProcessId', ['id' => $pro->id, 'process_id' => $process->id]) }}"><i
                                class="fas fa-pencil-alt text-info" aria-hidden="true"></i></a>
                        <button  class="btn btn-link text-danger text-gradient px-3 mb-0" type="button"
                            wire:click="destroyAction({{ $pro->id }},{{ $pro->id }})"
                            onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"><i
                                class="far fa-trash-alt"></i></button>
                    </div>
                </div>
                @endforeach
                @if(sizeof($processAction) == 0)
                    <p class="text-black-50 font-weight-light text-sm text-center my-4">Data masih kosong.</p>
                @endif
            </div>
        </div>
    </div>
    @endif
</section>