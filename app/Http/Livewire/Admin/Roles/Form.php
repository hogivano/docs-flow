<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Form extends Component
{
    public $idRole = null;
    public $role;
    public $name;

    protected $rules = [
        'role' => 'required|string',
        'name' => 'required|string'
    ];

    public function store() {
        $validatedData = $this->validate();
        if ($validatedData) {
            return $validatedData;
        }
        Role::create($validatedData);
        return redirect()->route('roles.index');
    }

    public function update() {

    }

    public function mount($id = null) {
        $this->idRole = $id;
    }

    public function render()
    {
        return view('livewire.admin.roles.form');
    }
}
