<?php

namespace App\Http\Livewire\Admin\User;

use Session;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Form extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $role_id = '';
    public $roles = [];
    public $data = null;
    public $title = 'User Baru';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'string|min:6',
        'role_id' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['password'] = Hash::make($this->password);
        $user = User::create($validatedData);
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $this->role_id,
        ]);
        Session::flash('success', 'Berhasil tambah user');
        return redirect()->route('user.index');
    }

    public function update($id) {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        }
        User::find($id)->update($validatedData);
        UserRole::where('user_id', $id)->update([
            'role_id' => $this->role_id,
        ]);

        Session::flash('success', 'Berhasil edit user');
        return redirect()->route('user.index');
    }

    public function mount($id = null) {
        $this->idUser = $id;
        $this->roles = Role::all();

        if ($id) {
            $this->title = 'User Edit';
            $this->data = User::find($id);

            if (!$this->data) {
                Session::flash('error', 'User tidak ditemukan');
                return redirect()->route('roles.index');
            }
            $userRole = UserRole::where('user_id', $this->data->id)->first();

            $this->name = $this->data->name;
            $this->email = $this->data->email;
            $this->role_id = ($userRole) ? $userRole->role_id : '';
        }
    }

    public function render()
    {
        return view('livewire.admin.user.form');
    }
}
