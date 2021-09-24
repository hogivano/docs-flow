<section>
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <h5 class="mb-0 text-black-50">Application</h5>
                    <h5 class="mb-1 pt-2 text-bold mb-3">{{ $application->title }}</h5>
                </div>
                <div>
                    <a class="bg-info px-2 py-1 mx-1 rounded-2 cursor-pointer" 
                        href="{{ route('application.edit', ['id' => $application->id]) }}">
                        <i class="fas fa-pen text-white"></i>
                    </a>
                </div>
            </div>
            <div class="text-black-50 text-sm mb-2">
                {{ $application->description }}
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                    checked="{{ ($application->is_ordered == 1) ? true : false }}" disabled>
                <label class="form-check-label" for="flexSwitchCheckDefault">Harus Urut</label>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="title">
                    <h5 class="mb-2">Process</h5>
                </div>
                <div class="d-flex align-items-center">
                    <button wire:click="toggleModal" class="btn btn-link text-info" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ubah Urutan
                    </button>
                    <a href="{{ route('process.create.application', ['application_id' => $application->id]) }}" wire:click="toggleModal"
                        class="btn bg-gradient-primary">Baru</a>
                </div>
            </div>
            <div class="list-group">
                @foreach ($processes as $process)
                <div wire:key="{{ $process->id }}" class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">{{ $process->title }}</h6>
                        <p class="text-black-50 text-sm">{{ $process->description }}</p>
                        <span class="mb-2 text-xs">Message Pending: <span class="text-dark font-weight-bold ms-sm-2">
                            {{ $process->message_pending }}</span></span>
                        <span class="mb-2 text-xs text-danger">Message Failure: <span
                                class="text-dark ms-sm-2 font-weight-bold">{{ $process->message_failure }}</span></span>
                        <span class="text-xs text-success">Message Success: <span
                                class="text-dark ms-sm-2 font-weight-bold">{{ $process->message_success }}</span></span>
                        <div class="mt-3 text-sm">
                            Process Action : @if(sizeof($process->processAction) > 0) {{ sizeof($process->processAction) }} @else <span class="text-danger">Belum disetting</span> @endif
                        </div>
                    </div>
                    <div class="ms-auto text-end">
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('process.detail', ['id' => $process->id]) }}">
                            <i class="far fa-eye text-dark"></i>
                        </a>
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('process.edit', ['id' => $process->id]) }}"><i
                                class="fas fa-pencil-alt text-info" aria-hidden="true"></i></a>
                        <button  class="btn btn-link text-danger text-gradient px-3 mb-0" type="button"
                            wire:click="destroyProcess({{ $process->id }},{{ $application->id }})"
                            onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"><i
                                class="far fa-trash-alt"></i></button>
                    </div>
                </div>
                @endforeach
                @if(sizeof($processes) == 0)
                    <p class="text-black-50 font-weight-light text-sm text-center my-4">Data masih kosong.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Urutan Process</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('admin.application.order-process', ['application_id' => $application->id])
                </div>
            </div>
        </div>
    </div>
</section>
