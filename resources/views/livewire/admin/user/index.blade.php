<div class="card">
    <div class="card-body p-3">
        <div class="d-flex h-100 justify-content-between">
            <div class="d-flex flex-column">
                <p class="mb-1 pt-2 text-bold">Data akun login tiap orang</p>
                <h5 class="font-weight-bolder">User</h5>
            </div>
            <div>
                <a href="{{ route('user.create') }}" type="button"
                    class="btn bg-gradient-primary">Baru</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                        </th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @if($user->userRole)
                                    {{ $user->userRole->Role->name }}
                                @else
                                    <p class="text-danger mb-0">Unset</p>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a class="bg-info px-2 mx-1 rounded-2 cursor-pointer"
                                        href="{{ route('user.edit', ['id' => $user->id]) }}">
                                        <i class="fas fa-pen text-white"></i>
                                    </a>
                                    @if($user->id > 1)
                                        <a class="bg-danger mx-1 px-2 rounded-2 cursor-pointer"
                                            onclick="confirm('Confirm delete this item?') || event.stopImmediatePropagation()"
                                            wire:click="destroy({{ $user->id }})">
                                            <i class="fas fa-times text-white"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
