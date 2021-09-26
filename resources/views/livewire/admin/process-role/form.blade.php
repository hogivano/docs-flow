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
            <div class="d-flex justify-content-between">
                <div class="title">
                    <p class="mb-1 pt-2 text-bold">Setting hak akses process ke role user</p>
                    <h5 class="font-weight-bolder">Setting Permission Role</h5>
                </div>
                <div class="form-group">
                    <label>Pilih process</label>
                    <select class="form-control"
                        wire:model="process_id" wire:change="changeOption">
                        <option value="" class="text-black-50">pilih process</option>
                        @foreach ($processes as $process)
                        <option value="{{ $process->id }}">
                            {{ $process->title }}
                        </option>
                        @endforeach
                    </select>
                    <small>Digunakan untuk menentukan permission setiap role.</small>
                </div>
            </div>
            @if(sizeof($processes) > 0)
            <form wire:submit.prevent="submit">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Role
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Read
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Create
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Update
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $index => $role)
                            <tr>
                                @if($role->role)
                                <td>
                                    {{ $role->role->role }}
                                </td>
                                @endif
                                @if($role->process)
                                    <td>
                                        <div class="form-check">
                                            <input @if($role->role->id == 1) disabled @endif class="form-check-input" wire:model="read.{{$index}}" type="checkbox" value="{{ $role->id }}" checked="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input @if($role->role->id == 1) disabled @endif class="form-check-input" wire:model="created.{{$index}}" type="checkbox" value="{{ $role->id }}" checked="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input @if($role->role->id == 1) disabled @endif class="form-check-input" wire:model="updated.{{$index}}" type="checkbox" value="{{ $role->id }}" checked="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input @if($role->role->id == 1) disabled @endif class="form-check-input" wire:model="deleted.{{$index}}" type="checkbox" value="{{ $role->id }}" checked="">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($showButton)
                    <div class="w-100 text-right mt-4">
                        <button type="submit" class="btn bg-gradient-primary">
                            Simpan
                        </button>
                    </div>
                    @endif
                </div>
            </form>
            @else
                <div class="text-center">Harus setting process terlebih dahulu.</div>
            @endif
        </div>
    </div>
</section>