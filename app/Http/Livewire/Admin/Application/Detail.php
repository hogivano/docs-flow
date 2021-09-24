<?php

namespace App\Http\Livewire\Admin\Application;

use Session;
use App\Models\Application;
use App\Models\Process;
use Livewire\Component;

class Detail extends Component
{
    public $processes = [];
    public $application;
    public $showModal = false;

    protected $listeners = ['toggleModal'];

    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

    public function mount($id) {
        $this->application = Application::where('id', $id)->first();
        if (!$this->application) {
            Session::flash('error', 'Application tidak ditemukan');
            return redirect()->route('application.index');
        }
        $this->processes = Process::where('application_id', $id)->with('processAction')->orderBy('order', 'asc')->get();
    }

    public function regenerateOrderProcess($applicationId) {
        $allProcess = Process::where('application_id', $applicationId)->orderBy('order', 'ASC')->get();
        $index = 1;
        foreach ($allProcess as $process) {
            $process->order = $index;
            $process->save();
            $index++;
        }
    }

    public function destroyProcess($id, $applicationId) {
        // return response()->json($id);
        Process::where('id', $id)->delete();
        // $this->regenerateOrderProcess($applicationId);
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('application.detail', ['id' => $applicationId]);
    }

    public function render()
    {
        return view('livewire.admin.application.detail');
    }
}
