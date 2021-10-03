<section>
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <h5 class="mb-0 text-black-50">Permohonan</h5>
                    <h5 class="mb-1 pt-2 text-bold mb-3">{{ $submission->title }}</h5>
                </div>
                <div>
                    <a class="bg-info px-2 py-1 mx-1 rounded-2 cursor-pointer" 
                        href="{{ route('permohonan.edit', ['id' => $submission->id]) }}">
                        <i class="fas fa-pen text-white"></i>
                    </a>
                </div>
            </div>
            <div class="text-black-50 text-sm mb-2">
                {{ $submission->description }}
            </div>
            <div>
                <span class="mb-2 text-sm">Template: <span class="text-dark font-weight-bold ms-sm-2">
                    {{ ($submission->application) ? $submission->application->title : ''}}</span></span>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="title mb-4">
                <h5 class="mb-0">Proses Permohonan</h5>
            </div>
            @if(sizeof($process) > 0)
            <div class="list-process">
                @php
                    $countDone = 0;
                    $lastDone = true;
                @endphp
                @foreach($process as $pro)
                <div class="timeline timeline-one-side">
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            @if(sizeof($pro->processAction) > 0)
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($pro->processAction as $action)
                                    @php
                                        if (sizeof($action->processActionUser) > 0) {
                                            $count++;
                                        }
                                    @endphp
                                @endforeach
                                {{-- untuk mengecek apakah telah diisi --}}
                                @if($count == sizeof($pro->processAction))
                                    @php
                                        $countDone++;
                                    @endphp
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-ellipsis-h text-secondary"></i>
                                @endif
                            @endif
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark font-weight-bold mb-0">{{ $pro->title }}</h6>
                            @if(sizeof($pro->processAction) > 0)
                                <form method="post" action="{{ route('permohonan.submit-action', ['id' => $submission->id])}}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach($pro->processAction as $action)
                                    <div class="mt-1 mb-0">
                                        @if($action->baseAction)
                                            <input value="{{ $action->id }}" hidden name="action_id[]" />
                                            <input type="text" value="{{ $action->baseAction->type }}" name="action_type[{{ $action->id }}]" hidden>
                                                @if (sizeof($action->processActionUser) > 0)
                                                    @php
                                                        $value = $action->processActionUser[0];
                                                    @endphp
                                                @else
                                                    @php
                                                        $value = null;
                                                    @endphp
                                                @endif
                                            @if($action->baseAction->type == 'file')
                                                <div class="form-group">
                                                    <label class="text-secondary font-weight-bold text-xs">{{ $action->label_input }}</label>
                                                    <input type="file" required name="action{{request()->id.$action->id}}" class="form-control">
                                                </div>
                                                @if ($value)
                                                    <a href="/{{ $value->value }}" target="_blank" class="text-sm text-info">Download File</a>
                                                @endif
                                            @elseif($action->baseAction->type == 'boolean')
                                                <div class="form-check mb-2">
                                                    @if ($value)
                                                        <input name="action[{{$action->id}}]" @if($value->value == 1) checked @endif class="form-check-input text-secondary font-weight-bold text-xs" style="height: 20px; width: 20px;" type="checkbox" value="1">
                                                    @else
                                                        <input name="action[{{$action->id}}]" class="form-check-input text-secondary font-weight-bold text-xs" style="height: 20px; width: 20px;" type="checkbox" value="1">
                                                    @endif
                                                    <label class="custom-control-label" for="customCheck1">{{ $action->label_input }}</label>
                                                </div>
                                            @elseif($action->baseAction->type == 'datetime')
                                                <div class="form-group mb-2">
                                                    <label class="text-secondary font-weight-bold text-xs">{{ $action->label_input }}</label>
                                                    @if ($value)
                                                        <input value="{{ $value->value }}" name="action[{{$action->id}}]" required type="date" class="form-control">
                                                    @else
                                                        <input name="action[{{$action->id}}]" required type="date" class="form-control">
                                                    @endif
                                                </div>
                                                @if ($value)
                                                    <div class="text-dark text-sm">
                                                        {{ $action->label_input }} : <b>{{ date_format(date_create($value->value), 'd M Y') }}</b>
                                                    </div>
                                                @endif
                                            @elseif($action->baseAction->type == 'text')
                                                <div class="form-group mb-2">
                                                    <label class="text-secondary font-weight-bold text-xs">{{ $action->label_input }}</label>
                                                    @if ($value)
                                                    <input name="action[{{$action->id}}]" value="{{ $value->value }}" required type="text" class="form-control">
                                                    @else
                                                    <input name="action[{{$action->id}}]" required type="text" class="form-control">
                                                    @endif
                                                </div>
                                                @if ($value)
                                                    <div class="text-dark text-sm">
                                                        {{ $action->label_input }} : <b>{{ $value->value }}</b>
                                                    </div>
                                                @endif
                                            @elseif($action->baseAction->type == 'number')
                                                <div class="form-group mb-2">
                                                    <label class="text-secondary font-weight-bold text-xs">{{ $action->label_input }}</label>
                                                    @if ($value)
                                                    <input name="action[{{$action->id}}]" value="{{ $value->value }}" required type="number" class="form-control">
                                                    @else
                                                    <input name="action[{{$action->id}}]" required type="number" class="form-control">
                                                    @endif
                                                </div>
                                                @if ($value)
                                                    <div class="text-dark text-sm">
                                                        {{ $action->label_input }} : <b>{{ number_format((int) $value->value) }}</b>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($value)
                                                <div class="mb-4">
                                                    <small class="text-xs">Dibuat pada : {{ date_format($value->created_at, 'd M Y') }}</small>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    @endforeach
                                    @if($submission->application)
                                        @if($submission->application->is_ordered == 1)
                                            @if($lastDone)
                                                <button type="submit" class="btn btn-outline-dark btn-sm">
                                                    Simpan
                                                </button>
                                            @else
                                                <button type="button" disabled class="btn btn-outline-dark btn-sm">
                                                    Simpan
                                                </button>
                                                <div>
                                                    <small class="text-secondary">Mohon isi secara runtut</small>
                                                </div>
                                            @endif
                                        @else
                                            <button type="submit" class="btn btn-outline-dark btn-sm">
                                                Simpan
                                            </button>
                                        @endif
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @php
                    $lastDone = ($count == sizeof($pro->processAction));
                @endphp
                @endforeach
                <div class="timeline timeline-one-side">
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            @if($countDone == sizeof($process))
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-ellipsis-h text-secondary"></i>
                            @endif
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark font-weight-bold mb-0">Selesai</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
