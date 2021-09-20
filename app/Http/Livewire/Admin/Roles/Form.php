<?php

namespace App\Http\Livewire\Admin\Roles;

use Route;
use App\Models\Role;
use Livewire\Component;

class Form extends Component
{
    public $idRole = null;
    public $data = null;
    public $role = '';
    public $name = '';
    public $title = 'Role Baru';

    protected $rules = [
        'role' => 'required',
        'name' => 'required'
    ];

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        Role::create($validatedData);
        Session::flash('success', 'Berhasil menambahkan role');
        return redirect()->route('roles.index');
    }

    public function update($id) {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        Role::where('id', $id)->update([
            'role' => $this->role,
            'name' => $this->name
        ]);
        Session::flash('success', 'Berhasil edit role');
        return redirect()->route('roles.index');
    }

    public function mount($id = null) {
        $this->idRole = $id;
        if ($id){
            $this->title = 'Role Edit';
            $this->data = Role::where('id', $id)->first();
            if (!$this->data) {
                Session::flash('error', 'Role tidak ditemukan');
                return redirect()->route('roles.index');
            }
            $this->role = $this->data->role;
            $this->name = $this->data->name; 
        }
    }

    public function render()
    {
        return view('livewire.admin.roles.form');
    }
}
