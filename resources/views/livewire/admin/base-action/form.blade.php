<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $titleRoute }}</h5>
        <form wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="nama input" required
                            wire:model="name">
                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type" required
                            wire:model="type">
                            <option value="" class="text-black-50">pilih tipe input</option>
                            @foreach ($typeOption as $option)
                            <option value="{{ $option }}">
                                {{ $option }}
                            </option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="validation" wire:model="validation" />
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" placeholder="lokasi file: ex.docs-penting"
                            wire:model="location">
                        <small>Lokasi file digunakan hanya untuk tipe file</small>
                        @error('location')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Min Karakter</label>
                        <input type="number" class="form-control" placeholder="minimum karakter input"
                            wire:model="min">
                        <small>Untuk validasi minimum karakter input. Isi 0 jika tidak ada batasan</small>
                        @error('min')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Max Karakter</label>
                        <input type="number" class="form-control" placeholder="maximum karakter input"
                            wire:model="max">
                        <small>Untuk validasi maximum karakter input. Isi 0 jika tidak ada batasan</small>
                        @error('max')
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
