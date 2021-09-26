<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $title }}</h5>
        <form
            wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role" placeholder="role" required
                            wire:model="role">
                        <div>
                            <small class="text-xxs">Unique type</small>
                        </div>
                        @error('role')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" wire:model="name" required placeholder="nama role"
                            class="form-control" />
                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-primary">
                {{ (isset($data)) ? 'Update' : 'Simpan' }}
            </button>
        </form>
    </div>
</div>
