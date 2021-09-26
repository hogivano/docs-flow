<?php

namespace App\Http\Livewire\Admin\ProcessRole;

use Session;
use App\Models\Application;
use App\Models\Process;
use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $applications = [];

    public function mount() {
        $this->applications = Application::all();
    }
    
    public function render()
    {
        return view('livewire.admin.process-role.index');
    }
}
