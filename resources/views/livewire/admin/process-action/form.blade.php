<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $titleRoute }}</h5>
        <form
            wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Process</label>
                        <select class="form-control" name="process_id" required
                            wire:model="process_id" @if($disableOption) disabled @endif>
                            <option value="" class="text-black-50">pilih process</option>
                            @foreach ($process as $pro)
                            <option value="{{ $pro->id }}">
                                {{ $pro->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('process_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Base Input</label>
                        <select class="form-control" name="base_action_id" required
                            wire:model="base_action_id">
                            <option value="" class="text-black-50">pilih input</option>
                            @foreach ($baseAction as $base)
                            <option value="{{ $base->id }}">
                                {{ $base->name }} - {{ $base->type }}
                            </option>
                            @endforeach
                        </select>
                        <small>Jenis input form yang dipilih</small>
                        @error('base_action_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Relasi Process Action</label>
                        <select class="form-control" name="related_process_action_id"
                            wire:model="related_process_action_id">
                            <option value="" class="text-black-50">pilih related process</option>
                            @foreach ($relatedProcessAction as $pro)
                            <option value="{{ $pro->id }}">
                                {{ $pro->label_input }}
                            </option>
                            @endforeach
                        </select>
                        <small>Process action yang berkesinambungan</small>
                        @error('related_process_action_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Label Input</label>
                        <input type="text" class="form-control" name="label_input" placeholder="judul label input" required
                            wire:model="label_input">
                        @error('label_input')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" wire:model="is_required" type="checkbox" value="1" checked="">
                        <label class="custom-control-label">Mandatory</label>
                    </div>
                    <small>Untuk validasi apakah action harus digunakan.</small>
                    @error('is_required')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" wire:model="process_show" type="checkbox" value="1" checked="">
                        <label class="custom-control-label">Tampilkan Informasi Pesan</label>
                    </div>
                    <small>Untuk menampilkan informasi input ke user.</small>
                    @error('process_show')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title (Optional)</label>
                        <input type="text" class="form-control" name="title" placeholder="judul"
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
                        <label>Description (Optional)</label>
                        <textarea type="text" name="description" wire:model="description" placeholder="deskripsi"
                            class="form-control" /></textarea>
                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Message Pending</label>
                        <textarea type="text" name="message_pending" wire:model="message_pending" placeholder="pesan pending"
                            class="form-control" /></textarea>
                        @error('message_pending')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Message Failure</label>
                        <textarea type="text" name="message_failure" wire:model="message_failure" placeholder="pesan gagal"
                            class="form-control" /></textarea>
                        @error('message_failure')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Message Success</label>
                        <textarea type="text" name="message_success" wire:model="message_success" placeholder="pesan berhasil/selesai"
                            class="form-control" /></textarea>
                        @error('message_success')
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
