<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex h-100 justify-content-between">
                <div class="d-flex flex-column">
                    <p class="mb-1 pt-2 text-bold">Untuk diberikan hak akses tiap user</p>
                    <h5 class="font-weight-bolder">Role User</h5>
                </div>
                <div>
                    <a href="{{ route('roles.create') }}" type="button"
                        class="btn bg-gradient-primary">Baru</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $role)
                            <tr>
                                <td>
                                    {{ $role->role }}
                                </td>
                                <td>
                                    {{ $role->name }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a class="bg-info px-2 mx-1 rounded-2 cursor-pointer" href="{{ route('roles.edit', ['id' => $role->id]) }}">
                                            <i class="fas fa-pen text-white"></i>
                                        </a>
                                        <a class="bg-danger mx-1 px-2 rounded-2 cursor-pointer">
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
</div>
