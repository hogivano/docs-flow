<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $titleRoute }}</h5>
        <form
            wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Template Permohonan</label>
                            <select class="form-control" name="application_id" required
                                wire:model="application_id">
                                <option value="" class="text-black-50">pilih template</option>
                                @foreach ($applications as $application)
                                <option value="{{ $application->id }}">
                                    {{ $application->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('application_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control text-uppercase" name="code" placeholder="kode permohonan" required
                            wire:model="code">
                        <div>
                            <small>Hanya bisa dibuat satu kali, tidak bisa diedit</small>
                        </div>
                        @error('code')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" wire:model="description" placeholder="deskripsi"
                                class="form-control" /></textarea>
                            @error('description')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-primary">
                {{ (isset($data)) ? 'Update' : 'Simpan' }}
            </button>
        </form>
    </div>
</div>
