<?php

namespace App\Http\Livewire\Admin\User;

use App\User;
use App\Role;
use App\UserRole;
use Livewire\Component;

class Form extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $role_id = '';
    public $roles = [];
    public $idUser = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|password',
        'role_id' => 'required'
    ];

    public function store() {

    }

    public function update() {

    }

    public function mount($id = null) {
        $this->idUser = $id;
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.user.form');
    }
}
