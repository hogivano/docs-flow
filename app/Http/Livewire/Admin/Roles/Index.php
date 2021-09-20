<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.roles.index');
    }
}
