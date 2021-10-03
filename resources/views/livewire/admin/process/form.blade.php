<div class="card">
    <div class="card-body p-3">
        <h5 class="font-weight-bolder">{{ $titleRoute }}</h5>
        <form
            wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Template Permohonan</label>
                        <select class="form-control" name="application_id" required
                            wire:model="application_id" @if($disableOption) disabled @endif>
                            <option value="" class="text-black-50">pilih application</option>
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
                        <textarea type="text" name="message_pending" wire:model="message_pending" required placeholder="pesan pending"
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
                        <textarea type="text" name="message_failure" wire:model="message_failure" required placeholder="pesan gagal"
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
                        <textarea type="text" name="message_success" wire:model="message_success" required placeholder="pesan berhasil/selesai"
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
