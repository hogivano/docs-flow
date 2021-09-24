<div class="card">
    <div class="card-body p-3">
        <div class="d-flex h-100 justify-content-between">
            <div class="d-flex flex-column">
                <p class="mb-1 pt-2 text-bold">Untuk master input form</p>
                <h5 class="font-weight-bolder">Base Action</h5>
            </div>
            <div>
                <a href="{{ route('base-action.create') }}" type="button"
                    class="btn bg-gradient-primary">Baru</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Name
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Type
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Location
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Validation
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Min
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Max
                        </th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $base)
                        <tr>
                            <td>
                                {{ $base->name }}
                            </td>
                            <td>
                                {{ $base->type }}
                            </td>
                            <td>
                                {{ $base->location }}
                            </td>
                            <td>
                                {{ $base->validation }}
                            </td>
                            <td>
                                {{ $base->min }}
                            </td>
                            <td>
                                {{ $base->max }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a class="bg-info px-2 mx-1 rounded-2 cursor-pointer"
                                        href="{{ route('base-action.edit', ['id' => $base->id]) }}">
                                        <i class="fas fa-pen text-white"></i>
                                    </a>
                                    <a class="bg-danger mx-1 px-2 rounded-2 cursor-pointer"
                                        onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"
                                        wire:click="destroy({{ $base->id }})">
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
