<?php

namespace App\Http\Livewire\Admin\Roles;

use Session;
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

    public function checkOnDbRole($new) {
        $route = ($this->data) ? route('roles.edit', ['id' => $this->data->id]) : route('roles.create');
        $role = Role::where('role', $new)->first();
        if ($role) {
            $errors = $this->getErrorBag();
            $errors->add('role', 'The role has already been taken.');
            return $errors;
        }
        return null;
    }

    public function checkRoleUnique($new, $old = null) {
        if ($old) {
            if ($old != $new) {
                return $this->checkOnDbRole($new);
            }
        } else {
            return $this->checkOnDbRole($new);
        }
        return null;
    }

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $checkUnique = $this->checkRoleUnique($this->role);
        if ($checkUnique) {
            return $checkUnique;
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
        $update = Role::find($id);
        $checkUnique = $this->checkRoleUnique($this->role, $update->role);
        if ($checkUnique) {
            return $checkUnique;
        }
        
        $update->update([
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
