<?php

namespace App\Http\Livewire\Admin\Process;

use Session;
use App\Models\Application;
use App\Models\ProcessAction;
use App\Models\Process;
use Livewire\Component;

class Detail extends Component
{
    public $application;
    public $process;
    public $rules;
    public $processAction = [];

    public function mount($id) {
        $this->process = Process::find($id);
        $this->application = Application::find($this->process->application_id);
        $this->processAction = ProcessAction::where('process_id', $id)->get();

        if (!$this->process && !$this->application) {
            Session::flash('error', 'Data tidak ditemukan');
            return redirect()->back();
        }
    }

    public function destroyAction($id, $process_id) {
        ProcessAction::find($id)->delete();
        return redirect()->route('process.detail', ['id' => $process_id]);
    }

    public function render()
    {
        return view('livewire.admin.process.detail');
    }
}
