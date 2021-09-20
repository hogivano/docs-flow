    <div class="card">
        <div class="card-body p-3">
            <h5 class="font-weight-bolder">{{ $title }}</h5>
            <form
                wire:submit.prevent="{{ (isset($data)) ? 'update('. $data->id . ')' : 'store' }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="name" required
                                wire:model="name">
                            @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" wire:model="email" required placeholder="john.dao@xxx.com"
                                class="form-control" />
                            @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role_id" wire:model="role_id" required>
                                <option value="" class="text-black-50">Pilih role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password
                                {{ strpos($title, 'Edit') ? 'Baru' : '' }}</label>
                            <input type="password" class="form-control" name="password" wire:model="password" placeholder="john.dao@xxx.com"
                                @if(!isset($data)) required @endif>
                            @error('password')
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
