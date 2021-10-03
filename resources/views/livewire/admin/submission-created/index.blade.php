<section>
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex h-100 justify-content-between">
                <div class="d-flex flex-column">
                    <p class="mb-1 pt-2 text-bold">Memberikan hak akses untuk create/menambah permohonan</p>
                    <h5 class="font-weight-bolder">Permohonan Hak Akses</h5>
                </div>
            </div>
            <div class="w-50">
                <select class="form-control" name="role_id" required
                    wire:model="role_id">
                    <option value="" class="text-black-50">pilih role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>