<div class="card">
    <div class="card-body p-3">
        <div class="d-flex h-100 justify-content-between">
            <div class="d-flex flex-column">
                <p class="mb-1 pt-2 text-bold">Untuk application flow dokumen</p>
                <h5 class="font-weight-bolder">Application Docs</h5>
            </div>
            <div>
                <a href="{{ route('application.create') }}" type="button"
                    class="btn bg-gradient-primary">Baru</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Title
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Description
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Alur Runtut
                        </th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $app)
                        <tr>
                            <td>
                                {{ $app->title }}
                            </td>
                            <td>
                                {{ $app->description }}
                            </td>
                            <td>
                                @if($app->is_ordered == 1)
                                Ya
                                @else
                                Tidak
                                @endif 
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a class="bg-success px-2 mx-1 rounded-2 cursor-pointer"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="tahap proses" data-container="body" data-animation="true">
                                        <i class="fas fa-sitemap text-white"></i>
                                    </a>
                                    <a class="bg-info px-2 mx-1 rounded-2 cursor-pointer"
                                        href="{{ route('application.edit', ['id' => $app->id]) }}">
                                        <i class="fas fa-pen text-white"></i>
                                    </a>
                                    <a class="bg-danger mx-1 px-2 rounded-2 cursor-pointer"
                                        onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"
                                        wire:click="destroy({{ $app->id }})">
                                        <i class="fas fa-times text-white"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
