<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $titleRoute }}</h5>
        <form
            wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="judul" required
                            wire:model="title">
                        @error('title')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" wire:model="description" required placeholder="deskripsi"
                            class="form-control" />
                        </textarea>
                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" wire:model="is_ordered" type="checkbox" value="1" checked="">
                        <label class="custom-control-label">Urutan</label>
                    </div>
                    <small>Untuk aktifkan alur proses secara runtut.</small>
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-primary">
                {{ (isset($data)) ? 'Update' : 'Simpan' }}
            </button>
        </form>
    </div>
</div>
