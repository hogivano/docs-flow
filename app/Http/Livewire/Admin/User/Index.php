<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = User::with('userRole.role')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.index');
    }
}
