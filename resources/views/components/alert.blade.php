@if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> {{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
        </button>
    </div>
@elseif($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Warning!</strong>{{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@elseif($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Danger!</strong> {{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
