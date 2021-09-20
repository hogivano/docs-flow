<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body p-3">
            <h5 class="font-weight-bolder">Role {{ strpos(Route::currentRouteName(), 'edit') ? 'Edit' : 'Baru' }}</h5>
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control"
                                placeholder="role" wire:model="role">
                            <small class="text-xxs">Unique type</small>
                            @error('role')
                                <span class="invalid-feedback">
                                        {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" wire:model="name" required placeholder="nama role" class="form-control" />
                            @error('name')
                                <span class="invalid-feedback">
                                        {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
