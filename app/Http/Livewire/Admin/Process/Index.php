<?php

namespace App\Http\Livewire\Admin\Process;

use Session;
use App\Models\Application;
use App\Models\Process;
use Livewire\Component;

class Index extends Component
{
    public $data = [];
    public $application;

    public function mount($application_id) {
        $this->application = Application::find($application_id);

        if ($this->application) {
            Session::flash('error', 'Application tidak ditemukan');
            return redirect()->route('application.index');
        }
        $this->data = Process::where('application_id', $application_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.process.index');
    }
}
